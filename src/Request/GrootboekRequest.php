<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\Grootboek;

final class GrootboekRequest extends BaseRequest
{
    public static function findAll(ODataRequestData $ODataRequestData): RequestInterface
    {
        return new Request("GET", "grootboeken?" . $ODataRequestData->getHttpCompatibleQueryString());
    }

    public static function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "grootboeken/" . $id->toString());
    }

    public static function add(Grootboek $grootboek): RequestInterface
    {
        return new Request("POST", "grootboeken", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($grootboek)));
    }

    public static function update(Grootboek $grootboek): RequestInterface
    {
        return new Request("PUT", "grootboeken/" . $grootboek->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($grootboek)));
    }
}