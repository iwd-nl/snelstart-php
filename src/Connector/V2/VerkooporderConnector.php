<?php
/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector\V2;

use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Mapper\V2\VerkooporderMapper;
use SnelstartPHP\Model\V2\Verkooporder;
use SnelstartPHP\Request\V2\VerkooporderRequest;

final class VerkooporderConnector extends BaseConnector
{
    public function add(Verkooporder $verkooporder): Verkooporder
    {
        if ($verkooporder->getId() !== null) {
            throw new PreValidationException("Verkooporder ID should be null");
        }

        $verkooporderMapper = new VerkooporderMapper();
        $verkooporderRequst = new VerkooporderRequest();

        return $verkooporderMapper->add($this->connection->doRequest($verkooporderRequst->add($verkooporder)));
    }
}