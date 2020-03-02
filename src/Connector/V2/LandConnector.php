<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Connector\V2;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V2\LandMapper;
use SnelstartPHP\Model\Land;
use SnelstartPHP\Request\V2\LandRequest;

final class LandConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Land
    {
        try {
            $mapper = new LandMapper();
            $request = new LandRequest();

            return $mapper->find($this->connection->doRequest($request->find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    /**
     * @template T as Land
     * @psalm-return \Generator<T>
     * @return iterable
     */
    public function findAll(): iterable
    {
        $mapper = new LandMapper();
        $request = new LandRequest();

        return $mapper->findAll($this->connection->doRequest($request->findAll()));
    }
}