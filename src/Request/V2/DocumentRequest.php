<?php

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\Type\DocumentType;
use SnelstartPHP\Model\V2\Document;
use SnelstartPHP\Model\V2\Inkoopboeking;
use SnelstartPHP\Model\V2\Relatie;
use SnelstartPHP\Model\V2\Verkoopboeking;
use SnelstartPHP\Request\BaseRequest;

final class DocumentRequest extends BaseRequest
{
    public function find(UuidInterface $id): RequestInterface
    {
        return new Request("GET", "documenten/" . $id->toString());
    }

    public function findByDocumentTypeAndParentIdentifier(DocumentType $documentType, UuidInterface $parentIdentifier): RequestInterface
    {
        return new Request("GET", sprintf("documenten/%s/%s", $documentType->getValue(), $parentIdentifier->toString()));
    }

    public function addVerkoopBoekingDocument(Document $document, Verkoopboeking $verkoopboeking): RequestInterface
    {
        if ($verkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return $this->fromDocumentType($document->setParentIdentifier($verkoopboeking->getId()), DocumentType::VERKOOPBOEKINGEN());
    }

    public function addInkoopBoekingDocument(Document $document, Inkoopboeking $inkoopboeking): RequestInterface
    {
        if ($inkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return $this->fromDocumentType($document->setParentIdentifier($inkoopboeking->getId()), DocumentType::INKOOPBOEKINGEN());
    }

    public function addRelatieDocument(Document $document, Relatie $relatie): RequestInterface
    {
        if ($relatie->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return $this->fromDocumentType($document->setParentIdentifier($relatie->getId()), DocumentType::RELATIES());
    }

    public function updateDocument(Document $document): RequestInterface
    {
        if ($document->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("PUT", "documenten/" . $document->getId()->toString(), [
            "Content-Type"  =>  "application/json",
        ], \GuzzleHttp\json_encode($this->prepareAddOrEditRequestForSerialization($document)));
    }

    public function deleteDocument(Document $document): RequestInterface
    {
        if ($document->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("DELETE", "documenten/" . $document->getId()->toString());
    }

    protected function fromDocumentType(Document $document, DocumentType $documentType): RequestInterface
    {
        return new Request("POST", sprintf("documenten/%s", $documentType->getValue()), [
            "Content-Type" =>   "application/json",
        ], \GuzzleHttp\json_encode($this->prepareAddOrEditRequestForSerialization($document)));
    }
}