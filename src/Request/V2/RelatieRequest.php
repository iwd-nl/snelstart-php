<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Request\BaseRequest;
use SnelstartPHP\Request\ODataRequestDataInterface;

final class RelatieRequest extends BaseRequest
{
    public function findAll(ODataRequestDataInterface $ODataRequestData): RequestInterface
    {
        return new Request("GET", "relaties?" . $ODataRequestData->getHttpCompatibleQueryString());
    }

    public function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "relaties/" . $id->toString());
    }

    public function add(Model\Relatie $relatie): RequestInterface
    {
        return new Request("POST", "relaties", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode($this->prepareAddOrEditRequestForSerialization($relatie)));
    }

    public function update(Model\Relatie $relatie): RequestInterface
    {
        if ($relatie->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("PUT", "relaties/" . $relatie->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode($this->prepareAddOrEditRequestForSerialization($relatie)));
    }
}