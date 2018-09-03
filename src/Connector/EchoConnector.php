<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector;

use SnelstartPHP\Request\EchoRequest;

class EchoConnector extends BaseConnector
{
    public function echo(string $input): string
    {
        return (string) str_replace('"', "", $this->connection->doRequest(EchoRequest::echo($input))->getBody());
    }
}