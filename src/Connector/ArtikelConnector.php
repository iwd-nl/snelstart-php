<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Request\ArtikelRequest;
use SnelstartPHP\Mapper\ArtikelMapper;
use SnelstartPHP\Model\Artikel;

class ArtikelConnector extends BaseConnector
{
    public function find(UuidInterface $id): ?Artikel
    {
        try {
            return ArtikelMapper::find($this->connection->doRequest(ArtikelRequest::find($id)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    public function findAll(): iterable
    {
        return ArtikelMapper::findAll($this->connection->doRequest(ArtikelRequest::findAll()));
    }
}