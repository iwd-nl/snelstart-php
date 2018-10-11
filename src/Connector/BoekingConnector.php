<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector;

use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Mapper\BoekingMapper;
use SnelstartPHP\Model\Inkoopboeking;
use SnelstartPHP\Model\Verkoopboeking;
use SnelstartPHP\Request\BoekingRequest;
use SnelstartPHP\Request\ODataRequestData;

class BoekingConnector extends BaseConnector
{
    /**
     * @return Inkoopboeking[]|iterable
     */
    public function findInkoopfactuur(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $inkoopfacturen = BoekingMapper::findAllInkoopfacturen($this->connection->doRequest(BoekingRequest::findInkoopfactuur($ODataRequestData)));
        $iterator = $previousResults ?? new \AppendIterator();

        if ($inkoopfacturen->valid()) {
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

    public function addInkoopboeking(Inkoopboeking $inkoopboeking): Inkoopboeking
    {
        if ($inkoopboeking->getId() !== null) {
            throw new PreValidationException("New records should not have an ID.");
        }

        $inkoopboeking->assertInBalance();
        return BoekingMapper::addInkoopboeking($this->connection->doRequest(BoekingRequest::addInkoopboeking($inkoopboeking)));
    }

    /**
     * @return Verkoopboeking[]|iterable
     */
    public function findVerkoopfactuur(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $verkoopfacturen = BoekingMapper::findAllVerkoopfacturen($this->connection->doRequest(BoekingRequest::findVerkoopfactuur($ODataRequestData)));
        $iterator = $previousResults ?? new \AppendIterator();

        if ($verkoopfacturen->valid()) {
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

    public function addVerkoopboeking(Verkoopboeking $verkoopboeking): Verkoopboeking
    {
        if ($verkoopboeking->getId() !== null) {
            throw new PreValidationException("New records should not have an ID.");
        }

        $verkoopboeking->assertInBalance();
        return BoekingMapper::addVerkoopboeking($this->connection->doRequest(BoekingRequest::addVerkoopboeking($verkoopboeking)));
    }
}