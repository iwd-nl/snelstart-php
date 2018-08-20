<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SnelstartPHP\Exception\SnelstartApiAccessDeniedException;
use SnelstartPHP\Secure\BearerToken\BearerTokenInterface;

class AccessTokenConnectionTest extends TestCase
{
    /**
     * @var ClientInterface|MockObject
     */
    private $client;

    /**
     * @var BearerTokenInterface|MockObject
     */
    private $token;

    private const DEFAULT_HEADERS = [
        "Cache-Control"         =>  "no-cache",
        "Content-Encoding"      =>  "gzip",
        "Content-Type"          =>  "application/json;charset=UTF-8",
        "Expires"               =>  -1,
        "Pragma"                =>  "no-cache",
        "Request-Context"       =>  "appId=cid-vxxx",
    ];

    public function setUp()
    {
        $this->client = $this->createMock(ClientInterface::class);
        $this->token = $this->createMock(BearerTokenInterface::class);
        $this->token->method("getFormParams")->willReturn([]);
    }

    public function testGetTokenSuccess()
    {
        $accessTokenContent = [
            "access_token"  =>  "test",
            "expires_in"    =>  3600,
            "token_type"    =>  "bearer",
        ];

        $successResponse = new Response(200, self::DEFAULT_HEADERS, json_encode($accessTokenContent));
        $this->client->expects($this->once())
            ->method("send")
            ->willReturn($successResponse);

        $connection = new AccessTokenConnection($this->token, $this->client);
        $accessToken = $connection->getToken();

        $this->assertEquals(new AccessToken($accessTokenContent, $this->token), $accessToken);
        $this->assertEquals("bearer", $accessToken->getTokenType());
        $this->assertEquals("test", (string) $accessToken);
        $this->assertFalse($accessToken->isExpired());
    }

    public function testGetAccessTokenInvalidCredentials()
    {
        $this->expectException(SnelstartApiAccessDeniedException::class);
        $this->expectExceptionMessage("Error message will be put here");

        $errorResponse = new Response(400, self::DEFAULT_HEADERS, json_encode([
            "error" =>  "Error message will be put here",
        ]));

        $this->client->expects($this->once())
            ->method("send")
            ->willThrowException(BadResponseException::create(new Request("POST", "test"), $errorResponse));

        $connection = new AccessTokenConnection($this->token, $this->client);
        $connection->getToken();
    }

    public function testAccessTokenWithoutBearerTokenSupplied()
    {
        $this->expectException(\InvalidArgumentException::class);
        $connection = new AccessTokenConnection(null, $this->client);
        $connection->getToken();

    }
}
