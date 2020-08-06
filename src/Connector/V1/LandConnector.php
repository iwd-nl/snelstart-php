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
use SnelstartPHP\Mapper\V1\LandMapper;
use SnelstartPHP\Model\Land;
use SnelstartPHP\Request\V1\LandRequest;

/**
 * @deprecated
 */
final class LandConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?\SnelstartPHP\Model\Land
    {
        try {
            return LandMapper::find($this->connection->doRequest(LandRequest::find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    /**
     * @return Land[]
     */
    public function findAll(): iterable
    {
        return LandMapper::findAll($this->connection->doRequest(LandRequest::findAll()));
    }
}