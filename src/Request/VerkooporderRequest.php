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
use SnelstartPHP\Model\Verkooporder;

class VerkooporderRequest extends BaseRequest
{
    public static function findAll(): RequestInterface
    {
        return new Request("GET", "verkooporders");
    }

    public static function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "verkooporders/" . $id->toString());
    }

    public static function addVerkoopOrder(Verkooporder $verkooporder): RequestInterface
    {
        return new Request("POST", "verkooporders", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($verkooporder)));
    }
}