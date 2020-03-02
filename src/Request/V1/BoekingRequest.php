<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Request\V1;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\V1 as Model;
use SnelstartPHP\Request\BaseRequest;
use SnelstartPHP\Request\ODataRequestDataInterface;

/**
 * @deprecated
 */
final class BoekingRequest extends BaseRequest
{
    public static function findInkoopfactuur(ODataRequestDataInterface $ODataRequestData): RequestInterface
    {
        return new Request("GET", "inkoopfacturen?" . $ODataRequestData->getHttpCompatibleQueryString(), [
            "Content-Type"  =>  "application/json"
        ]);
    }

    public static function findVerkoopfactuur(ODataRequestDataInterface $ODataRequestData): RequestInterface
    {
        return new Request("GET", "verkoopfacturen?" . $ODataRequestData->getHttpCompatibleQueryString(), [
            "Content-Type"  =>  "application/json"
        ]);
    }

    public static function addInkoopboeking(Model\Inkoopboeking $inkoopboeking): RequestInterface
    {
        return new Request("POST", "inkoopboekingen", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::getInstance()->prepareAddOrEditRequestForSerialization($inkoopboeking)));
    }

    public static function updateInkoopboeking(Model\Inkoopboeking $inkoopboeking): RequestInterface
    {
        if ($inkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("PUT", "inkoopboekingen/" . $inkoopboeking->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::getInstance()->prepareAddOrEditRequestForSerialization($inkoopboeking)));
    }

    public static function addAttachmentToInkoopboeking(Model\Inkoopboeking $inkoopboeking, Model\Bijlage $bijlage): RequestInterface
    {
        if ($inkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("POST", sprintf("inkoopboekingen/%s/bijlagen", $inkoopboeking->getId()->toString()), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::getInstance()->prepareAddOrEditRequestForSerialization($bijlage)));
    }

    public static function addVerkoopboeking(Model\Verkoopboeking $verkoopboeking): RequestInterface
    {
        return new Request("POST", "verkoopboekingen", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::getInstance()->prepareAddOrEditRequestForSerialization($verkoopboeking)));
    }

    public static function updateVerkoopboeking(Model\Verkoopboeking $verkoopboeking): RequestInterface
    {
        if ($verkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("PUT", "verkoopboekingen/" . $verkoopboeking->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::getInstance()->prepareAddOrEditRequestForSerialization($verkoopboeking)));
    }

    public static function addAttachmentToVerkoopboeking(Model\Verkoopboeking $verkoopboeking, Model\Bijlage $bijlage): RequestInterface
    {
        if ($verkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("POST", sprintf("verkoopboekingen/%s/bijlagen", $verkoopboeking->getId()->toString()), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::getInstance()->prepareAddOrEditRequestForSerialization($bijlage)));
    }
    
    private static function getInstance(): self
    {
        return new self();
    }
}