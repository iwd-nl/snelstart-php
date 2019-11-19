<?php
/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use SnelstartPHP\Exception\{
    ExpiredAccessTokenException,
    IncompleteRequestException,
    MaxRetriesReachedException,
    RateLimitException,
    SnelstartApiAccessDeniedException,
    SnelstartApiErrorException,
    SnelstartResourceNotFoundException
};

abstract class BaseConnection implements ConnectionInterface
{
    /**
     * @var ApiSubscriptionKey
     */
    protected $subscriptionKey;

    /**
     * @var AccessToken
     */
    protected $accessToken;

    /**
     * @var LoggerInterface|null
     */
    protected $logger;

    /**
     * @var ClientInterface|null
     */
    protected $client;

    /**
     * Maximum amount of times to retry in case of failure like a timeout.
     */
    protected const MAX_RETRIES = 3;

    /**
     * @var int
     */
    private $numRetries = 0;

    private const SUBSCRIPTION_HEADER_NAME = "Ocp-Apim-Subscription-Key";

    public function setClient(ClientInterface $client): self
    {
        $this->client = $client;
        return $this;
    }

    public function setAccessToken(AccessToken $accessToken): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    public function setLogger(LoggerInterface $logger): self
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @throws RateLimitException
     * @throws MaxRetriesReachedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function doRequest(RequestInterface $request): ResponseInterface
    {
        $client = $this->getClient();

        try {
            if (!$request->hasHeader(self::SUBSCRIPTION_HEADER_NAME)) {
                $request = $this->setOrReplaceSubscriptionKeyInRequest($request, $this->subscriptionKey->getPrimary());
            }

            $this->preRequestValidation($request = $request->withHeader("Authorization", sprintf("Bearer %s", $this->accessToken->getAccessToken())));
            $this->numRetries++;

            if ($this->logger !== null) {
                $this->logger->debug("[Connection] About to send a request with the following specs", [
                    "method"    =>  $request->getMethod(),
                    "uri"       =>  (string) $request->getUri(),
                ]);
            }

            $response = $client->send($request);
            $this->numRetries = 0;

            return $response;
        } catch (ServerException $serverException) {
            throw new SnelstartResourceNotFoundException($serverException->getMessage(), $serverException->getRequest(), $serverException->getResponse(), $serverException);
        } catch (ClientException $clientException) {
            $response = $clientException->getResponse();

            if ($response === null) {
                throw new \RuntimeException("We haven't received any response or whatsoever.");
            }

            if ($response->getStatusCode() === 400) {
                $jsonBody = (string) $response->getBody();
                $body = \GuzzleHttp\json_decode($jsonBody, true);

                if ($this->logger !== null) {
                    $this->logger->error("[Connection] " . $jsonBody, [
                        "exception" =>  $clientException
                    ]);
                }

                throw SnelstartApiErrorException::handleError($body);
            } else if ($response->getStatusCode() === 401) {
                throw SnelstartApiAccessDeniedException::createFromParent($clientException);
            } else if ($response->getStatusCode() === 403) {
                throw new SnelstartApiAccessDeniedException($response->getReasonPhrase(), $request);
            } else if ($response->getStatusCode() === 404) {
                $body = (string) $response->getBody();

                if (mb_strlen($body) > 0) {
                    $body = \GuzzleHttp\json_decode($body, true);
                }

                throw new SnelstartResourceNotFoundException(
                    $body["Message"] ?? "Resource not found",
                    $request,
                    $response,
                    $clientException
                );
            } else if ($response->getStatusCode() === 429) {
                // We received another 429 on the secondary key. Throw a different exception.
                if (in_array($this->subscriptionKey->getSecondary(), $request->getHeader(self::SUBSCRIPTION_HEADER_NAME))) {
                    throw new MaxRetriesReachedException();
                }

                // API Rate Limit reached
                $request = $this->setOrReplaceSubscriptionKeyInRequest($request, $this->subscriptionKey->getSecondary());
            }

            return $this->doRequest($request);
        }
    }

    /**
     * @throws MaxRetriesReachedException
     * @throws IncompleteRequestException
     * @throws ExpiredAccessTokenException
     */
    protected function preRequestValidation(RequestInterface $request): void
    {
        if ($this->numRetries === self::MAX_RETRIES) {
            throw new MaxRetriesReachedException(sprintf("We tried to reach Snelstart %d times without luck. Retry later.", self::MAX_RETRIES));
        }

        if ($this->accessToken->isExpired()) {
            throw new ExpiredAccessTokenException("Access token is expired. Please refresh the access token.");
        }

        if (empty($request->getHeader("Ocp-Apim-Subscription-Key"))) {
            throw new IncompleteRequestException("We require the subscription key as set in the constructor.");
        }
    }

    protected function setOrReplaceSubscriptionKeyInRequest(RequestInterface $request, string $key): RequestInterface
    {
        if ($this->logger !== null && $request->hasHeader(self::SUBSCRIPTION_HEADER_NAME)) {
            $this->logger->debug(sprintf("[Connection] Replacing the subscription key in the request to '%s'", $key));
        }

        $request = $request->withHeader(self::SUBSCRIPTION_HEADER_NAME, $key);
        return $request;
    }

    protected function getClient(): ClientInterface
    {
        if ($this->client === null) {
            $this->client = new Client([
                'base_uri'  =>  static::getEndpoint(),
                'timeout'   =>  60,
            ]);
        }

        return $this->client;
    }
}