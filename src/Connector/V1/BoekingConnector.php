<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Connector\V1;

use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Mapper\V1 as Mapper;
use SnelstartPHP\Model\V1 as Model;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\V1 as Request;

/**
 * @deprecated
 */
final class BoekingConnector extends BaseConnector
{
    /**
     * @return Model\Inkoopboeking[]|iterable
     */
    public function findInkoopfactuur(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $inkoopfacturen = Mapper\BoekingMapper::findAllInkoopfacturen($this->connection->doRequest(Request\BoekingRequest::findInkoopfactuur($ODataRequestData)));
        $iterator = $previousResults ?? new \AppendIterator();

        if ($iterator instanceof \AppendIterator && $inkoopfacturen->valid()) {
            $iterator->append($inkoopfacturen);
        }

        if ($fetchAll && $inkoopfacturen->valid()) {
            if ($ODataRequestData->getSkip() === 0) {
                $ODataRequestData->setSkip(1);
            } else {
                $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
            }

            return $this->findInkoopfactuur($ODataRequestData, true, $iterator);
        }

        return $iterator;
    }

    public function addInkoopboeking(Model\Inkoopboeking $inkoopboeking): Model\Inkoopboeking
    {
        if ($inkoopboeking->getId() !== null) {
            throw new PreValidationException("New records should not have an ID.");
        }

        $inkoopboeking->assertInBalance();
        return Mapper\BoekingMapper::addInkoopboeking($this->connection->doRequest(Request\BoekingRequest::addInkoopboeking($inkoopboeking)));
    }


    public function addInkoopboekingBijlage(Model\Inkoopboeking $inkoopboeking, Model\InkoopboekingBijlage $bijlage): Model\Bijlage
    {
        if ($inkoopboeking->getId() === null) {
            throw new PreValidationException("We can only add an attachment to an existing booking.");
        }

        return Mapper\BoekingMapper::addBijlage($this->connection->doRequest(Request\BoekingRequest::addAttachmentToInkoopboeking($inkoopboeking, $bijlage)), get_class($bijlage));
    }

    /**
     * @return Model\Verkoopboeking[]|iterable
     */
    public function findVerkoopfactuur(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $verkoopfacturen = Mapper\BoekingMapper::findAllVerkoopfacturen($this->connection->doRequest(Request\BoekingRequest::findVerkoopfactuur($ODataRequestData)));
        $iterator = $previousResults ?? new \AppendIterator();

        if ($iterator instanceof \AppendIterator && $verkoopfacturen->valid()) {
            $iterator->append($verkoopfacturen);
        }

        if ($fetchAll && $verkoopfacturen->valid()) {
            if ($ODataRequestData->getSkip() === 0) {
                $ODataRequestData->setSkip(1);
            } else {
                $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
            }

            return $this->findVerkoopfactuur($ODataRequestData, true, $iterator);
        }

        return $iterator;
    }

    public function addVerkoopboeking(Model\Verkoopboeking $verkoopboeking): Model\Verkoopboeking
    {
        if ($verkoopboeking->getId() !== null) {
            throw new PreValidationException("New records should not have an ID.");
        }

        $verkoopboeking->assertInBalance();

        if ($verkoopboeking->getVervaldatum() !== null && $verkoopboeking->getBetalingstermijn() === null) {
            $verkoopboeking->setBetalingstermijn((int) (new \DateTime())->diff($verkoopboeking->getVervaldatum())->format("%a"));
        }

        return Mapper\BoekingMapper::addVerkoopboeking($this->connection->doRequest(Request\BoekingRequest::addVerkoopboeking($verkoopboeking)));
    }

    public function addVerkoopboekingBijlage(Model\Verkoopboeking $verkoopboeking, Model\VerkoopboekingBijlage $bijlage): Model\Bijlage
    {
        if ($verkoopboeking->getId() === null) {
            throw new PreValidationException("We can only add an attachment to an existing booking.");
        }

        return Mapper\BoekingMapper::addBijlage($this->connection->doRequest(Request\BoekingRequest::addAttachmentToVerkoopboeking($verkoopboeking, $bijlage)), get_class($bijlage));
    }
}