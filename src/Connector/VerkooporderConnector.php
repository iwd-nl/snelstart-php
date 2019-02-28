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

    public function findAll(): iterable
    {
        return VerkooporderMapper::findAll($this->connection->doRequest(VerkooporderRequest::findAll()));
    }
}