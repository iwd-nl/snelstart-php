<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Request\V1;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\V1 as Model;
use SnelstartPHP\Request\BaseRequest;
use SnelstartPHP\Request\ODataRequestDataInterface;

/**
 * @deprecated
 */
final class GrootboekRequest extends BaseRequest
{
    public static function findAll(ODataRequestDataInterface $ODataRequestData): RequestInterface
    {
        return new Request("GET", "grootboeken?" . $ODataRequestData->getHttpCompatibleQueryString());
    }

    public static function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "grootboeken/" . $id->toString());
    }

    public static function add(Model\Grootboek $grootboek): RequestInterface
    {
        return new Request("POST", "grootboeken", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode((new static())->prepareAddOrEditRequestForSerialization($grootboek)));
    }

    public static function update(Model\Grootboek $grootboek): RequestInterface
    {
        if ($grootboek->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("PUT", "grootboeken/" . $grootboek->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode((new static())->prepareAddOrEditRequestForSerialization($grootboek)));
    }
}