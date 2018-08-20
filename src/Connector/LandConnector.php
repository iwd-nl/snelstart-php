<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Request\Read\Land as LandRequest;
use SnelstartPHP\Response\Read\Land;
use SnelstartPHP\Model\Land as LandModel;

class LandConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?LandModel
    {
        try {
            return Land::find($this->connection->doRequest(LandRequest::get($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    public function findAll(): array
    {
        $landen = [];

        foreach (Land::findAll($this->connection->doRequest(LandRequest::getAll())) as $land) {
            $landen[] = $land;
        }

        return $landen;
    }
}