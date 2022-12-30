<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Connector\V2;

use SnelstartPHP\Request\V2\EchoRequest;
use SnelstartPHP\Connector\BaseConnector;

final class EchoConnector extends BaseConnector
{
    public function echo(string $input): string
    {
        return str_replace('"', "", $this->connection->doRequest((new EchoRequest())->echo($input))->getBody()->getContents());
    }
}