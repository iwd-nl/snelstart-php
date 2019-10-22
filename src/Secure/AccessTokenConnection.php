<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use SnelstartPHP\Exception\SnelstartApiAccessDeniedException;
use SnelstartPHP\Secure\BearerToken\BearerTokenInterface;

final class AccessTokenConnection implements ConnectionInterface
{
    /**
     * @var ClientInterface|null
     */
    private $client;

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    /**
     * @var BearerTokenInterface|null
     */
    private $bearerToken;

    public function __construct(?BearerTokenInterface $bearerToken = null, ?ClientInterface $client = null, ?LoggerInterface $logger = null)
    {
        $this->client = $client;
        $this->bearerToken = $bearerToken;
        $this->logger = $logger;
    }

    /**
     * @param RequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function doRequest(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->getClient()->send($request);
        } catch (BadResponseException $badResponseException) {
            throw SnelstartApiAccessDeniedException::createFromParent($badResponseException);
        }
    }

    /**
     * Will throw an exception if we get anything other than a success.
     *
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken(?BearerTokenInterface $bearerToken = null): AccessToken
    {
        if ($bearerToken === null && $this->bearerToken === null) {
            throw new \InvalidArgumentException("You have to define the type of bearer token to use.");
        }

        $this->bearerToken = $bearerToken ?? $this->bearerToken;

        if ($this->logger !== null) {
            $this->logger->debug(sprintf("[AccessToken] Trying to obtain an access token with token type '%s'", get_class($this->bearerToken)));
        }

        $request = new Request("POST", static::getEndpoint() . "token", [
            "Content-Type"      =>  "application/x-www-form-urlencoded",
        ], http_build_query($this->bearerToken->getFormParams()));

        $response = $this->doRequest($request);

        return new AccessToken(
            \GuzzleHttp\json_decode($response->getBody(), true),
            $this->bearerToken
        );
    }

    public static function getEndpoint(): string
    {
        return "https://auth.snelstart.nl/b2b/";
    }

    private function getClient(): ClientInterface
    {
        if ($this->client === null) {
            return $this->client = new Client();
        }

        return $this->client;
    }
}