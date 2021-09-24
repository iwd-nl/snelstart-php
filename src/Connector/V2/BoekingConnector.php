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
     * @return iterable<Model\Inkoopboeking>
     */
    public function findInkoopfacturen(?ODataRequestDataInterface $ODataRequestData = null, bool $fetchAll = false, iterable $previousResults = null): iterable
    {
        $factuurRequest = new Request\FactuurRequest();
        $boekingMapper = new Mapper\BoekingMapper();
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $hasItems = false;

        foreach ($boekingMapper->findAllInkoopfacturen($this->connection->doRequest($factuurRequest->findInkoopfacturen($ODataRequestData))) as $inkoopboeking) {
            $hasItems = true;
            yield $inkoopboeking;
        }

        if ($fetchAll && $hasItems) {
            if ($previousResults === null) {
                $ODataRequestData->setSkip($ODataRequestData->getTop());
            } else {
                $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
            }

            yield from $this->findInkoopfacturen($ODataRequestData, true, []);
        }
    }

    public function addInkoopboeking(Model\Inkoopboeking $inkoopboeking): Model\Inkoopboeking
    {
        if ($inkoopboeking->getId() !== null) {
            throw PreValidationException::unexpectedIdException();
        }

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

    public function updateInkoopboeking(Model\Inkoopboeking $inkoopboeking): Model\Inkoopboeking
    {
        if ($inkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        $boekingMapper = new Mapper\BoekingMapper();
        $boekingRequest = new Request\BoekingRequest();

        return $boekingMapper->updateInkoopboeking($this->connection->doRequest($boekingRequest->updateInkoopboeking($inkoopboeking)));
    }

    public function updateVerkoopboeking(Model\Verkoopboeking $verkoopboeking): Model\Verkoopboeking
    {
        if ($verkoopboeking->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        $boekingMapper = new Mapper\BoekingMapper();
        $boekingRequest = new Request\BoekingRequest();

        return $boekingMapper->updateVerkoopboeking($this->connection->doRequest($boekingRequest->updateVerkoopboeking($verkoopboeking)));
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
     * @return iterable<Model\Verkoopboeking>
     */
    public function findVerkoopfacturen(?ODataRequestDataInterface $ODataRequestData = null, bool $fetchAll = false, iterable $previousResults = null): iterable
    {
        $factuurRequest = new Request\FactuurRequest();
        $boekingMapper = new Mapper\BoekingMapper();
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $hasItems = false;

        foreach ($boekingMapper->findAllVerkoopfacturen($this->connection->doRequest($factuurRequest->findVerkoopfacturen($ODataRequestData))) as $verkoopboeking) {
            $hasItems = true;
            yield $verkoopboeking;
        }

        if ($fetchAll && $hasItems) {
            if ($previousResults === null) {
                $ODataRequestData->setSkip($ODataRequestData->getTop());
            } else {
                $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
            }

            yield from $this->findVerkoopfacturen($ODataRequestData, true, []);
        }
    }

    public function addVerkoopboeking(Model\Verkoopboeking $verkoopboeking): Model\Verkoopboeking
    {
        if ($verkoopboeking->getId() !== null) {
            throw PreValidationException::unexpectedIdException();
        }

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
