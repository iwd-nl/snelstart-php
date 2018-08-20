<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure\BearerToken;

use PHPUnit\Framework\TestCase;

class PasswordBearerTokenTest extends TestCase
{
    public function testGetFormParams()
    {
        $instance = new PasswordBearerToken(base64_encode("test:test"));

        $this->assertEquals([
            "username"      =>  "test",
            "password"      =>  "test",
            "grant_type"    =>  "password",
        ], $instance->getFormParams());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage We expected 2 items while decoding this but we got 1
     */
    public function testInvalidKoppelsleutel()
    {
        $invalidKoppelsleutel = "randomteststring";
        new PasswordBearerToken($invalidKoppelsleutel);
    }
}
