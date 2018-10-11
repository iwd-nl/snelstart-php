<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use SnelstartPHP\Model\Inkoopboeking;
use SnelstartPHP\Model\Verkoopboeking;

class BoekingRequest extends BaseRequest
{
    public static function findInkoopfactuur(ODataRequestData $ODataRequestData): RequestInterface
    {
        return new Request("GET", "inkoopfacturen?" . $ODataRequestData->getHttpCompatibleQueryString(), [
            "Content-Type"  =>  "application/json"
        ]);
    }

    public static function findVerkoopfactuur(ODataRequestData $ODataRequestData): RequestInterface
    {
        return new Request("GET", "verkoopfacturen?" . $ODataRequestData->getHttpCompatibleQueryString(), [
            "Content-Type"  =>  "application/json"
        ]);
    }

    public static function addInkoopboeking(Inkoopboeking $inkoopboeking): RequestInterface
    {
        return new Request("POST", "inkoopboekingen", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($inkoopboeking)));
    }

    public static function updateInkoopboeking(Inkoopboeking $inkoopboeking)
    {
        return new Request("PUT", "inkoopboekingen/" . $inkoopboeking->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($inkoopboeking)));
    }

    public static function addVerkoopboeking(Verkoopboeking $verkoopboeking): RequestInterface
    {
        return new Request("POST", "verkoopboekingen", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($verkoopboeking)));
    }

    public static function updateVerkoopboeking(Verkoopboeking $verkoopboeking): RequestInterface
    {
        return new Request("PUT", "verkoopboekingen/" . $verkoopboeking->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($verkoopboeking)));
    }
}