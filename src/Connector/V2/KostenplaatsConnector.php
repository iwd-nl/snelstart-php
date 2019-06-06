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
            return Mapper\KostenplaatsMapper::find($this->connection->doRequest(Request\KostenplaatsRequest::find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    /**
     * @return Kostenplaats[]|iterable
     */
    public function findAll(): iterable
    {
        return Mapper\KostenplaatsMapper::findAll($this->connection->doRequest(Request\KostenplaatsRequest::findAll()));
    }

    public function add(Kostenplaats $kostenplaats): Kostenplaats
    {
        if ($kostenplaats->getId() !== null) {
            throw PreValidationException::unexpectedIdException();
        }

        return Mapper\KostenplaatsMapper::add($this->connection->doRequest(Request\KostenplaatsRequest::add($kostenplaats)));
    }

    public function update(Kostenplaats $kostenplaats): Kostenplaats
    {
        if ($kostenplaats->getId() !== null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return Mapper\KostenplaatsMapper::update($this->connection->doRequest(Request\KostenplaatsRequest::update($kostenplaats)));
    }

    public function delete(Kostenplaats $kostenplaats): void
    {
        if ($kostenplaats->getId() !== null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        Mapper\KostenplaatsMapper::delete($this->connection->doRequest(Request\KostenplaatsRequest::delete($kostenplaats)));
    }
}