<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Request\VerkooporderRequest;
use SnelstartPHP\Mapper\VerkooporderMapper;
use SnelstartPHP\Model\Verkooporder;

class VerkooporderConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Verkooporder
    {
        try {
            return VerkooporderMapper::find($this->connection->doRequest(VerkooporderRequest::find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    public function findAll($filter = null): iterable
    {
        return VerkooporderMapper::findAll($this->connection->doRequest(VerkooporderRequest::findAll($filter)));
    }

    public function addVerkoopOrder(Verkooporder $verkooporder): Verkooporder
    {
        if ($verkooporder->getId() !== null) {
            throw new PreValidationException("New records should not have an ID.");
        }

        return VerkooporderMapper::addVerkoopOrder($this->connection->doRequest(VerkooporderRequest::addVerkoopOrder($verkooporder)));
    }

    public function updateVerkoopOrder(Verkooporder $verkooporder): Verkooporder
    {
        if ($verkooporder->getId() === null) {
            throw new PreValidationException("Verkooporder should have an ID.");
        }

        return VerkooporderMapper::updateVerkoopOrder($this->connection->doRequest(VerkooporderRequest::updateVerkoopOrder($verkooporder)));
    }
}