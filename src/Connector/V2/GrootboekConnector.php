<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Connector\V2;

use AppendIterator;
use Iterator;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V2 as Mapper;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\V2 as Request;
use SnelstartPHP\Request\ODataRequestDataInterface;

final class GrootboekConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Model\Grootboek
    {
        try {
            $mapper = new Mapper\GrootboekMapper();
            $request = new Request\GrootboekRequest();

            return $mapper->find($this->connection->doRequest($request->find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    /**
     * @template T as Model\Grootboek
     * @psalm-return \Iterator<T>
     */
    public function findAll(?ODataRequestDataInterface $ODataRequestData = null, bool $fetchAll = false, ?Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $iterator = $previousResults ?? new AppendIterator();

        $mapper = new Mapper\GrootboekMapper();
        $request = new Request\GrootboekRequest();

        $grootboeken = $mapper->findAll($this->connection->doRequest($request->findAll($ODataRequestData)));

        if ($iterator instanceof AppendIterator && $grootboeken->valid()) {
            $iterator->append($grootboeken);
        }

        if ($fetchAll && $grootboeken->valid()) {
            if ($previousResults === null) {
                $ODataRequestData->setSkip($ODataRequestData->getTop());
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

        $mapper = new Mapper\GrootboekMapper();
        $request = new Request\GrootboekRequest();

        foreach ($mapper->findAll($this->connection->doRequest($request->findAll($criteria))) as $grootboek) {
            return $grootboek;
        }

        return null;
    }
}