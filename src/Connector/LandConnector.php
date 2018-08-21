<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Request\LandRequest;
use SnelstartPHP\Mapper\LandMapper;
use SnelstartPHP\Model\Land;

class LandConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Land
    {
        try {
            return LandMapper::find($this->connection->doRequest(LandRequest::find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    public function findAll(): \Iterator
    {
        return LandMapper::findAll($this->connection->doRequest(LandRequest::findAll()));
    }
}