<?php

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Request\BaseRequest;

final class BoekingRequest extends BaseRequest
{
    public function findInkoopboeking(UuidInterface $uuid): RequestInterface
    {
        return new Request("GET", "inkoopboekingen/" . $uuid->toString());
    }

    public function findVerkoopboeking(UuidInterface $uuid): RequestInterface
    {
        return new Request("GET", "verkoopboekingen/" . $uuid->toString());
    }

    public function addInkoopboeking(Model\Inkoopboeking $inkoopboeking): RequestInterface
    {
        return new Request("POST", "inkoopboekingen", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode($this->prepareAddOrEditRequestForSerialization($inkoopboeking)));
    }

    public function updateInkoopboeking(Model\Inkoopboeking $inkoopboeking): RequestInterface
    {
        if ($inkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("PUT", "inkoopboekingen/" . $inkoopboeking->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode($this->prepareAddOrEditRequestForSerialization($inkoopboeking)));
    }

    public function addVerkoopboeking(Model\Verkoopboeking $verkoopboeking): RequestInterface
    {
        return new Request("POST", "verkoopboekingen", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode($this->prepareAddOrEditRequestForSerialization($verkoopboeking)));
    }

    public function updateVerkoopboeking(Model\Verkoopboeking $verkoopboeking): RequestInterface
    {
        if ($verkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("PUT", "verkoopboekingen/" . $verkoopboeking->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode($this->prepareAddOrEditRequestForSerialization($verkoopboeking)));
    }

    /**
     * @deprecated Please see DocumentRequest
     */
    public function addAttachmentToInkoopboeking(Model\Inkoopboeking $inkoopboeking, Model\Document $document): RequestInterface
    {
        if ($inkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        @trigger_error(sprintf("Please use %s", DocumentRequest::class), \E_USER_DEPRECATED);

        return (new DocumentRequest($this->serializer))->addInkoopBoekingDocument($document, $inkoopboeking);
    }

    /**
     * @deprecated Please see DocumentRequest
     */
    public function addAttachmentToVerkoopboeking(Model\Verkoopboeking $verkoopboeking, Model\Document $document): RequestInterface
    {
        if ($verkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        @trigger_error(sprintf("Please use %s", DocumentRequest::class), \E_USER_DEPRECATED);
        return (new DocumentRequest($this->serializer))->addVerkoopBoekingDocument($document, $verkoopboeking);
    }
}