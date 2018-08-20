<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector;

use SnelstartPHP\Secure\ConnectionInterface;

abstract class BaseConnector
{
    /**
     * @var ConnectionInterface
     */
    protected $connection;

    public function __construct(ConnectionInterface $provider)
    {
        $this->setConnection($provider);
    }

    protected function setConnection(ConnectionInterface $provider): self
    {
        $this->connection = $provider;

        return $this;
    }
}