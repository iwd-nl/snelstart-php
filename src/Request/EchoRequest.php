<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

class EchoRequest extends BaseRequest
{
    public static function echo(string $input): RequestInterface
    {
        return new Request("GET", "echo/" . $input);
    }
}