<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Request\V1;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use SnelstartPHP\Request\BaseRequest;

/**
 * @deprecated
 */
final class EchoRequest extends BaseRequest
{
    public static function echo(string $input): RequestInterface
    {
        return new Request("GET", "echo/" . $input);
    }
}