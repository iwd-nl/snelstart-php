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

    public function __construct(?ClientInterface $client = null)
    {
        $this->client = $client;
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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken(BearerTokenInterface $bearerToken): AccessToken
    {
        $request = new Request("GET", "token");
        $response = $this->doRequest($request);

        return new AccessToken(\GuzzleHttp\json_decode($response->getBody(), true), $bearerToken);
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