<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Request\BaseRequest;
use SnelstartPHP\Request\ODataRequestData;

final class RelatieRequest extends BaseRequest
{
    public static function findAll(ODataRequestData $ODataRequestData): RequestInterface
    {
        return new Request("GET", "relaties?" . $ODataRequestData->getHttpCompatibleQueryString());
    }

    public static function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "relaties/" . $id->toString());
    }

    public static function add(Model\Relatie $relatie): RequestInterface
    {
        return new Request("POST", "relaties", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($relatie)));
    }

    public static function update(Model\Relatie $relatie): RequestInterface
    {
        return new Request("PUT", "relaties/" . $relatie->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($relatie)));
    }
}