<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request\Read;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;

class Land
{
    public static function findAll(): RequestInterface
    {
        return new Request("GET", "landen");
    }

    public static function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "landen/" . $id->toString());
    }
}