<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\RelatieMapper;
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

    public function findAll(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): \Iterator
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
}