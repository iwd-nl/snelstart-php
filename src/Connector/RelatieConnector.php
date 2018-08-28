<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\RelatieMapper;
use SnelstartPHP\Model\Type\Relatiesoort;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\RelatieRequest;
use SnelstartPHP\Model\Relatie;

class RelatieConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Relatie
    {
        try {
            return RelatieMapper::find($this->connection->doRequest(RelatieRequest::find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    public function findAll(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $relaties = RelatieMapper::findAll($this->connection->doRequest(RelatieRequest::findAll($ODataRequestData)));
        $iterator = $previousResults ?? new \AppendIterator();

        if ($relaties->valid()) {
            $iterator->append($relaties);
        }

        if ($fetchAll && $relaties->valid()) {
            if ($ODataRequestData->getSkip() === 0) {
                $ODataRequestData->setSkip(1);
            } else {
                $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
            }

            return $this->findAll($ODataRequestData, true, $iterator);
        }

        return $iterator;
    }

    public function findAllLeveranciers(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $ODataRequestData->setFilter(\array_merge(
            $ODataRequestData->getFilter(),
            [ sprintf("Relatiesoort/any(soort:soort eq '%s')", Relatiesoort::LEVERANCIER()) ])
        );

        return $this->findAll($ODataRequestData, $fetchAll, $previousResults);
    }

    public function findAllKlanten(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $ODataRequestData->setFilter(\array_merge(
            $ODataRequestData->getFilter(),
            [ sprintf("Relatiesoort/any(soort:soort eq '%s') or Relatiesoort/any(soort:soort eq '%s')", Relatiesoort::KLANT(), Relatiesoort::EIGEN()) ])
        );

        return $this->findAll($ODataRequestData, $fetchAll, $previousResults);
    }

    public function add(Relatie $relatie): Relatie
    {
        if ($relatie->getId() !== null) {
            throw new PreValidationException("The ID of this relation should be null.");
        }

        return RelatieMapper::add($this->connection->doRequest(RelatieRequest::add($relatie)));
    }

    public function update(Relatie $relatie): Relatie
    {
        if ($relatie->getId() === null) {
            throw new PreValidationException("All relations should have an ID.");
        }

        return RelatieMapper::update($this->connection->doRequest(RelatieRequest::update($relatie)));
    }
}