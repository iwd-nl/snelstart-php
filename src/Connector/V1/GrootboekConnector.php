<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Connector\V1;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V1 as Mapper;
use SnelstartPHP\Model\V1 as Model;
use SnelstartPHP\Request\V1 as Request;
use SnelstartPHP\Request\ODataRequestData;

/**
 * @deprecated
 */
final class GrootboekConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Model\Grootboek
    {
        try {
            return Mapper\GrootboekMapper::find($this->connection->doRequest(Request\GrootboekRequest::find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    public function findAll(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $grootboeken = Mapper\GrootboekMapper::findAll($this->connection->doRequest(Request\GrootboekRequest::findAll($ODataRequestData)));
        $iterator = $previousResults ?? new \AppendIterator();

        if ($iterator instanceof \AppendIterator && $grootboeken->valid()) {
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

    public function findByNumber(string $number): ?Model\Grootboek
    {
        $criteria = (new ODataRequestData())->setFilter([
            sprintf("Nummer eq %s", $number)
        ]);

        foreach (Mapper\GrootboekMapper::findAll($this->connection->doRequest(Request\GrootboekRequest::findAll($criteria))) as $grootboek) {
            return $grootboek;
        }

        return null;
    }
}