<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure\BearerToken;

use PHPUnit\Framework\TestCase;

class ClientKeyBearerTokenTest extends TestCase
{
    public function testGetFormParams()
    {
        $instance = new ClientKeyBearerToken("test");
        $this->assertEquals([
            "grant_type"    =>  "clientkey",
            "clientkey"     => "test"
        ], $instance->getFormParams());
    }
}
