<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Connector\V1;

use SnelstartPHP\Request\V1\EchoRequest;
use SnelstartPHP\Connector\BaseConnector;

/**
 * @deprecated
 */
final class EchoConnector extends BaseConnector
{
    public function echo(string $input): string
    {
        return (string) str_replace('"', "", $this->connection->doRequest(EchoRequest::echo($input))->getBody()->getContents());
    }
}