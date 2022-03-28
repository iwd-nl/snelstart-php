<?php

declare(strict_types=1);

namespace SnelstartPHP\Connector\V2;

use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Mapper\V2\BtwTariefMapper;
use SnelstartPHP\Model\V2\BtwTarief;
use SnelstartPHP\Request\V2\BtwTariefRequest;

final class BtwTariefConnector extends BaseConnector
{
    /**
     * @return iterable<BtwTarief>
     */
    public function findAll(): iterable
    {
        $btwTariefRequest = new BtwTariefRequest();
        $btwTariefMapper = new BtwTariefMapper();

        yield from $btwTariefMapper->findAll($this->connection->doRequest($btwTariefRequest->findAll()));
    }
}
