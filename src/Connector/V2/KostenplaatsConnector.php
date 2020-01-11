<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector\V2;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V2 as Mapper;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Request\V2 as Request;

final class KostenplaatsConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Kostenplaats
    {
        try {
            $request = new Request\KostenplaatsRequest();
            $mapper = new Mapper\KostenplaatsMapper();

            return $mapper->find($this->connection->doRequest($request->find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    /**
     * @return Kostenplaats[]|iterable
     */
    public function findAll(): iterable
    {
        return (new Mapper\KostenplaatsMapper())->findAll($this->connection->doRequest((new Request\KostenplaatsRequest())->findAll()));
    }

    public function add(Kostenplaats $kostenplaats): Kostenplaats
    {
        if ($kostenplaats->getId() !== null) {
            throw PreValidationException::unexpectedIdException();
        }

        return (new Mapper\KostenplaatsMapper())->add($this->connection->doRequest((new Request\KostenplaatsRequest())->add($kostenplaats)));
    }

    public function update(Kostenplaats $kostenplaats): Kostenplaats
    {
        if ($kostenplaats->getId() !== null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return (new Mapper\KostenplaatsMapper())->update($this->connection->doRequest((new Request\KostenplaatsRequest())->update($kostenplaats)));
    }

    public function delete(Kostenplaats $kostenplaats): void
    {
        if ($kostenplaats->getId() !== null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        (new Mapper\KostenplaatsMapper())->delete($this->connection->doRequest((new Request\KostenplaatsRequest())->delete($kostenplaats)));
    }
}