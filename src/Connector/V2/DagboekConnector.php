<?php

namespace SnelstartPHP\Connector\V2;

use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Mapper\V2\DagboekenMapper;
use SnelstartPHP\Model\V2\Dagboek;
use SnelstartPHP\Request\V2\DagboekenRequest;

final class DagboekConnector extends BaseConnector
{
    /**
     * @return Dagboek[]|\Generator
     */
    public function findAll(): \Generator
    {
        $request = new DagboekenRequest();
        $mapper = new DagboekenMapper();

        $response = $this->connection->doRequest($request->findAll());

        return $mapper->findAll($response);
    }
}
