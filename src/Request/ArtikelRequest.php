<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\Artikel;

class ArtikelRequest
{
    public static function findAll(): RequestInterface
    {
        return new Request("GET", "artikelen");
    }

    public static function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "artikelen/" . $id->toString());
    }
}