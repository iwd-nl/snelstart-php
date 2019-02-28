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

    public static function add(Artikel $artikel): RequestInterface
    {
        return new Request("POST", "artikelen", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($artikel)));
    }

    public static function update(Artikel $artikel): RequestInterface
    {
        return new Request("PUT", "artikelen/" . $artikel->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($artikel)));
    }

}