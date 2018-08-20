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
use SnelstartPHP\Exception\SnelstartApiAccessDeniedException;
use SnelstartPHP\Secure\BearerToken\BearerTokenInterface;

class AccessTokenConnection implements ConnectionInterface
{
    /**
     * @var ClientInterface|null
     */
    private $client;

    /**
     * @var BearerTokenInterface|null
     */
    private $bearerToken;

    public function __construct(?BearerTokenInterface $bearerToken = null, ?ClientInterface $client = null)
    {
        $this->client = $client;
        $this->bearerToken = $bearerToken;
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

        $request = new Request("GET", "token");
        $response = $this->doRequest($request);

        return new AccessToken(\GuzzleHttp\json_decode($response->getBody(), true), $this->bearerToken = $bearerToken ?? $this->bearerToken);
    }

    public function getEndpoint(): string
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