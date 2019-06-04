<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector\V1;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V1\LandMapper;
use SnelstartPHP\Model\V1\Land;
use SnelstartPHP\Request\V1\LandRequest;

final class LandConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Land
    {
        try {
            return LandMapper::find($this->connection->doRequest(LandRequest::find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    /**
     * @return Land[||iterable
     */
    public function findAll(): iterable
    {
        return LandMapper::findAll($this->connection->doRequest(LandRequest::findAll()));
    }
}