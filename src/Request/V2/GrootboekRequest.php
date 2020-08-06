<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Request\BaseRequest;
use SnelstartPHP\Request\ODataRequestDataInterface;

final class GrootboekRequest extends BaseRequest
{
    public function findAll(ODataRequestDataInterface $ODataRequestData): RequestInterface
    {
        return new Request("GET", "grootboeken?" . $ODataRequestData->getHttpCompatibleQueryString());
    }

    public function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "grootboeken/" . $id->toString());
    }

    public function add(Model\Grootboek $grootboek): RequestInterface
    {
        return new Request("POST", "grootboeken", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode($this->prepareAddOrEditRequestForSerialization($grootboek)));
    }

    public function update(Model\Grootboek $grootboek): RequestInterface
    {
        if ($grootboek->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("PUT", "grootboeken/" . $grootboek->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode($this->prepareAddOrEditRequestForSerialization($grootboek)));
    }
}