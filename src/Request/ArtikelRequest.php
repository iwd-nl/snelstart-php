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

class ArtikelRequest extends BaseRequest
{
    public static function findAll(ODataRequestData $ODataRequestData): RequestInterface
    {
        return new Request("GET", "artikelen?" . $ODataRequestData->getHttpCompatibleQueryString());
    }

    public static function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "artikelen/" . $id->toString());
    }

    public static function customFields(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "artikelen/" . $id->toString() . '/customFields');
    }

    public static function updateArtikel(Artikel $artikel)
    {
        return new Request("PUT", "artikelen/" . $artikel->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($artikel)));
    }
}