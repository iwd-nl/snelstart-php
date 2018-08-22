<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\Relatie;

class RelatieRequest extends BaseRequest
{
    public static function findAll(ODataRequestData $ODataRequestData): RequestInterface
    {
        return new Request("GET", "relaties?" . $ODataRequestData->getHttpCompatibleQueryString());
    }

    public static function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "relaties/" . $id->toString());
    }
}