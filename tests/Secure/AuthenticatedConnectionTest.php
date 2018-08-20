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
use Psr\Log\LoggerInterface;
use SnelstartPHP\Exception\MaxRetriesReachedException;

/**
 * @todo Write more unit tests to cover more client errors
 */
class AuthenticatedConnectionTest extends TestCase
{
    /**
     * @var AuthenticatedConnection|MockObject
     */
    protected $connection;

    /**
     * @var ClientInterface|MockObject
     */
    protected $client;

    /**
     * @var LoggerInterface|MockObject
     */
    protected $logger;

    public function setUp()
    {
        $accessToken = $this->createMock(AccessToken::class);
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->client = $this->createMock(ClientInterface::class);
        $subscriptionKey = new ApiSubscriptionKey("test123", "test456");

        $this->connection = $this->getMockBuilder(AuthenticatedConnection::class)
            ->enableOriginalConstructor()
            ->setConstructorArgs([
                "subscriptionKey"   =>  $subscriptionKey,
                "accessToken"       =>  $accessToken,
                "logger"            =>  $this->logger,
                "client"            =>  $this->client,
            ])
            ->setMethodsExcept([ "doRequest" ])
            ->getMock();
    }

    public function testMaxRetriesReachedOnBothKeys()
    {
        $returnMessage = [
            "statusCode"    =>  429,
            "message"       =>  "Rate limit is exceeded. Try again in x seconds.",
        ];

        $request = new Request("GET", "test");
        $response = new Response(429, [], json_encode($returnMessage));
        $e = BadResponseException::create($request, $response);

        $this->client->expects($this->exactly(2))
            ->method("send")
            ->willThrowException($e);

        $this->expectException(MaxRetriesReachedException::class);
        $this->connection->doRequest($request);
    }

    public function testMaxRetriesOnOneKey()
    {
        $firstResponse = [
            "statusCode"    =>  429,
            "message"       =>  "Rate limit is exceeded. Try again in x seconds.",
        ];
        $secondResponse = [
            "statusCode"    =>  200,
            "message"       =>  "",
        ];

        $firstRequest = new Request("GET", "test");
        $firstResponse = new Response(429, [], json_encode($firstResponse));
        $firstException = BadResponseException::create($firstRequest, $firstResponse);

        $secondResponse = new Response(200, [], json_encode($secondResponse));

        $this->client->expects($this->at(0))
            ->method("send")
            ->willThrowException($firstException);

        $this->client->expects($this->at(1))
            ->method("send")
            ->willReturn($secondResponse);

        $response = $this->connection->doRequest($firstRequest);
        $this->assertEquals(200, $response->getStatusCode());
}
}
