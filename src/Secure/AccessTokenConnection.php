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
use SnelstartPHP\Utils;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use SnelstartPHP\Exception\SnelstartApiAccessDeniedException;
use SnelstartPHP\Secure\BearerToken\BearerTokenInterface;

final class AccessTokenConnection implements ConnectionInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    /**
     * @var BearerTokenInterface
     */
    private $bearerToken;

    public function __construct(BearerTokenInterface $bearerToken, ?ClientInterface $client = null, ?LoggerInterface $logger = null)
    {
        $this->bearerToken = $bearerToken;
        $this->client = $client ?? new Client([
            "base_uri"  =>  static::getEndpoint(),
        ]);
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
            return $this->client->send($request);
        } catch (BadResponseException $badResponseException) {
            throw SnelstartApiAccessDeniedException::createFromParent($badResponseException);
        }
    }

    /**
     * Will throw an exception if we get anything other than a success.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken(?BearerTokenInterface $bearerToken = null): AccessToken
    {
        $this->bearerToken = $bearerToken ?? $this->bearerToken;

        if ($this->logger !== null) {
            $this->logger->debug(sprintf("[AccessToken] Trying to obtain an access token with token type '%s'", get_class($this->bearerToken)));
        }

        $request = new Request("POST", static::getEndpoint() . "token", [
            "Content-Type"      =>  "application/x-www-form-urlencoded",
        ], http_build_query($this->bearerToken->getFormParams()));

        $response = $this->doRequest($request);

        return new AccessToken(
            Utils::jsonDecode($response->getBody()->getContents(), true),
            $this->bearerToken
        );
    }

    public static function getEndpoint(): string
    {
        return "https://auth.snelstart.nl/b2b/";
    }
}