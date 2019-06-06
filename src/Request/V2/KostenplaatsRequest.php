<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Request\BaseRequest;

final class KostenplaatsRequest extends BaseRequest
{
    public static function findAll(): RequestInterface
    {
        return new Request("GET", "kostenplaatsen");
    }

    public static function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "kostenplaatsen/" . $id->toString());
    }

    public static function add(Kostenplaats $kostenplaats): RequestInterface
    {
        return new Request("POST", "kostenplaatsen", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($kostenplaats)));
    }

    public static function update(Kostenplaats $kostenplaats): RequestInterface
    {
        return new Request("PUT", "kostenplaatsen/" . $kostenplaats->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($kostenplaats)));
    }

    public static function delete(Kostenplaats $kostenplaats): RequestInterface
    {
        return new Request("PUT", "kostenplaatsen/" . $kostenplaats->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ]);
    }
}