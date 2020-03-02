<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Connector\V1;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V1 as Mapper;
use SnelstartPHP\Model\V1 as Model;
use SnelstartPHP\Model\Type\Relatiesoort;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\V1 as Request;

/**
 * @deprecated
 */
final class RelatieConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Model\Relatie
    {
        try {
            return Mapper\RelatieMapper::find($this->connection->doRequest(Request\RelatieRequest::find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    /**
     * @return Model\Relatie[]
     */
    public function findAll(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $relaties = Mapper\RelatieMapper::findAll($this->connection->doRequest(Request\RelatieRequest::findAll($ODataRequestData)));
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

    /**
     * @return Model\Relatie[]
     */
    public function findAllLeveranciers(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $ODataRequestData->setFilter(\array_merge(
            $ODataRequestData->getFilter(),
            [ sprintf("Relatiesoort/any(soort:soort eq '%s')", Relatiesoort::LEVERANCIER()) ])
        );

        return $this->findAll($ODataRequestData, $fetchAll, $previousResults);
    }

    /**
     * @return Model\Relatie[]
     */
    public function findAllKlanten(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $ODataRequestData->setFilter(\array_merge(
            $ODataRequestData->getFilter(),
            [ sprintf("Relatiesoort/any(soort:soort eq '%s') or Relatiesoort/any(soort:soort eq '%s')", Relatiesoort::KLANT(), Relatiesoort::EIGEN()) ])
        );

        return $this->findAll($ODataRequestData, $fetchAll, $previousResults);
    }

    public function add(Model\Relatie $relatie): Model\Relatie
    {
        if ($relatie->getId() !== null) {
            throw new PreValidationException("The ID of this relation should be null.");
        }

        return Mapper\RelatieMapper::add($this->connection->doRequest(Request\RelatieRequest::add($relatie)));
    }

    public function update(Model\Relatie $relatie): Model\Relatie
    {
        if ($relatie->getId() === null) {
            throw new PreValidationException("All relations should have an ID.");
        }

        return Mapper\RelatieMapper::update($this->connection->doRequest(Request\RelatieRequest::update($relatie)));
    }
}