<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Connector\V2;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V2 as Mapper;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\ODataRequestDataInterface;
use SnelstartPHP\Request\V2 as Request;

final class BoekingConnector extends BaseConnector
{
    public function findInkoopboeking(UuidInterface $uuid): ?Model\Inkoopboeking
    {
        $boekingRequest = new Request\BoekingRequest();
        $boekingMapper = new Mapper\BoekingMapper();

        try {
            return $boekingMapper->findInkoopboeking($this->connection->doRequest($boekingRequest->findInkoopboeking($uuid)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    /**
     * @template T as Model\Inkoopboeking
     * @psalm-return \Iterator<T>
     * @return Model\Inkoopboeking[]|iterable
     */
    public function findInkoopfacturen(?ODataRequestDataInterface $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $factuurRequest = new Request\FactuurRequest();
        $boekingMapper = new Mapper\BoekingMapper();

        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $inkoopfacturen = $boekingMapper->findAllInkoopboekingen($this->connection->doRequest($factuurRequest->findInkoopfacturen($ODataRequestData)));
        $iterator = $previousResults ?? new \AppendIterator();

        if ($iterator instanceof \AppendIterator && $inkoopfacturen->valid()) {
            $iterator->append($inkoopfacturen);
        }

        if ($fetchAll && $inkoopfacturen->valid()) {
            if ($previousResults === null) {
                $ODataRequestData->setSkip($ODataRequestData->getTop());
            } else {
                $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
            }

            return $this->findInkoopfacturen($ODataRequestData, true, $iterator);
        }

        return $iterator;
    }

    public function addInkoopboeking(Model\Inkoopboeking $inkoopboeking): Model\Inkoopboeking
    {
        if ($inkoopboeking->getId() !== null) {
            throw PreValidationException::unexpectedIdException();
        }

        $inkoopboeking->assertInBalance();

        $boekingMapper = new Mapper\BoekingMapper();
        $boekingRequest = new Request\BoekingRequest();

        return $boekingMapper->addInkoopboeking($this->connection->doRequest($boekingRequest->addInkoopboeking($inkoopboeking)));
    }

    public function addInkoopboekingDocument(Model\Inkoopboeking $inkoopboeking, Model\Document $document): Model\Document
    {
        if ($inkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        $documentMapper = new Mapper\DocumentMapper();
        $documentRequest = new Request\DocumentRequest();

        return $documentMapper->add($this->connection->doRequest($documentRequest->addInkoopBoekingDocument($document, $inkoopboeking)));
    }

    public function findVerkoopboeking(UuidInterface $uuid): ?Model\Verkoopboeking
    {
        $boekingRequest = new Request\BoekingRequest();
        $boekingMapper = new Mapper\BoekingMapper();

        try {
            return $boekingMapper->findVerkoopboeking($this->connection->doRequest($boekingRequest->findVerkoopboeking($uuid)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    /**
     * @template T as Model\Verkoopboeking
     * @psalm-return \Iterator<T>
     * @return Model\Verkoopboeking[]|iterable
     */
    public function findVerkoopfacturen(?ODataRequestDataInterface $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $factuurRequest = new Request\FactuurRequest();
        $boekingMapper = new Mapper\BoekingMapper();

        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $verkoopfacturen = $boekingMapper->findAllVerkoopboekingen($this->connection->doRequest($factuurRequest->findVerkoopfacturen($ODataRequestData)));
        $iterator = $previousResults ?? new \AppendIterator();

        if ($iterator instanceof \AppendIterator && $verkoopfacturen->valid()) {
            $iterator->append($verkoopfacturen);
        }

        if ($fetchAll && $verkoopfacturen->valid()) {
            if ($previousResults === null) {
                $ODataRequestData->setSkip($ODataRequestData->getTop());
            } else {
                $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
            }

            return $this->findVerkoopfacturen($ODataRequestData, true, $iterator);
        }

        return $iterator;
    }

    public function addVerkoopboeking(Model\Verkoopboeking $verkoopboeking): Model\Verkoopboeking
    {
        if ($verkoopboeking->getId() !== null) {
            throw PreValidationException::unexpectedIdException();
        }

        $verkoopboeking->assertInBalance();

        if ($verkoopboeking->getVervaldatum() !== null && $verkoopboeking->getBetalingstermijn() === null) {
            $verkoopboeking->setBetalingstermijn((int) (new \DateTime())->diff($verkoopboeking->getVervaldatum())->format("%a"));
        }

        $boekingMapper = new Mapper\BoekingMapper();
        $boekingRequest = new Request\BoekingRequest();

        return $boekingMapper->addVerkoopboeking($this->connection->doRequest($boekingRequest->addVerkoopboeking($verkoopboeking)));
    }

    public function addVerkoopboekingDocument(Model\Verkoopboeking $verkoopboeking, Model\Document $document): Model\Document
    {
        if ($verkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        $documentMapper = new Mapper\DocumentMapper();
        $documentRequest = new Request\DocumentRequest();

        return $documentMapper->add($this->connection->doRequest($documentRequest->addVerkoopBoekingDocument($document, $verkoopboeking)));
    }
}