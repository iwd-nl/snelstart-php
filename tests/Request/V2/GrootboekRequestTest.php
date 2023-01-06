<?php

namespace SnelstartPHP\Tests\Request\V2;

use Ramsey\Uuid\Uuid;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\V2\Grootboek;
use SnelstartPHP\Request\V2\GrootboekRequest;
use PHPUnit\Framework\TestCase;

class GrootboekRequestTest extends TestCase
{
    private $grootboekRequest;

    public function setUp(): void
    {
        $this->grootboekRequest = new GrootboekRequest();
    }

    public function testAddSuccessful(): void
    {
        $uuid = Uuid::uuid4();

        $grootboek = Grootboek::createFromUUID($uuid);

        $expected = [
            "id" => $uuid->toString(),
        ];
        $request = $this->grootboekRequest->add($grootboek);

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('grootboeken', $request->getUri());
        $this->assertJsonStringEqualsJsonString(
            json_encode($expected),
            $request->getBody()->getContents()
        );
    }

    public function testUpdateSuccessful(): void
    {
        $uuid = Uuid::uuid4();

        $grootboek = Grootboek::createFromUUID($uuid);

        $expected = [
            "id" => $uuid->toString(),
        ];
        $request = $this->grootboekRequest->update($grootboek);

        $this->assertEquals('PUT', $request->getMethod());
        $this->assertEquals(sprintf('%s/%s', 'grootboeken', $uuid->toString()), $request->getUri());
        $this->assertJsonStringEqualsJsonString(
            json_encode($expected),
            $request->getBody()->getContents()
        );
    }

    public function testUpdateWithException(): void
    {
        $this->expectException(PreValidationException::class);

        $grootboek = new Grootboek();

        $this->grootboekRequest->update($grootboek);
    }
}
