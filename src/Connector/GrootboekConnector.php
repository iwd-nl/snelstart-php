<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\GrootboekMapper;
use SnelstartPHP\Model\Grootboek;
use SnelstartPHP\Request\GrootboekRequest;
use SnelstartPHP\Request\ODataRequestData;

final class GrootboekConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Grootboek
    {
        try {
            return GrootboekMapper::find($this->connection->doRequest(GrootboekRequest::find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    public function findAll(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $grootboeken = GrootboekMapper::findAll($this->connection->doRequest(GrootboekRequest::findAll($ODataRequestData)));
        $iterator = $previousResults ?? new \AppendIterator();

        if ($grootboeken->valid()) {
            $iterator->append($grootboeken);
        }

        if ($fetchAll && $grootboeken->valid()) {
            if ($ODataRequestData->getSkip() === 0) {
                $ODataRequestData->setSkip(1);
            } else {
                $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
            }

            return $this->findAll($ODataRequestData, true, $iterator);
        }

        return $iterator;
    }

    public function findByNumber(string $number): ?Grootboek
    {
        $criteria = (new ODataRequestData())->setFilter([
            sprintf("Nummer eq %s", $number)
        ]);

        foreach (GrootboekMapper::findAll($this->connection->doRequest(GrootboekRequest::findAll($criteria))) as $grootboek) {
            return $grootboek;
        }

        return null;
    }
}