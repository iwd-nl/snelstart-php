<?php

namespace SnelstartPHP\Tests\Request\V2;

use GuzzleHttp\Psr7\Request;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Request\V2\LandRequest;
use PHPUnit\Framework\TestCase;

class LandRequestTest extends TestCase
{
    public function testFindAll()
    {
        $this->assertEquals(new Request("GET", "landen"), LandRequest::findAll());
    }

    public function testFindById()
    {
        $id = Uuid::uuid4();
        $this->assertEquals(new Request("GET", "landen/" . $id->toString()), LandRequest::find($id));
    }
}
