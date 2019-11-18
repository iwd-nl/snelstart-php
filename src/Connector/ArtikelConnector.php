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
use SnelstartPHP\Request\ODataRequestData;

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

    public function customFields(UuidInterface $id)
    {
        try {
            return json_decode($this->connection->doRequest(ArtikelRequest::customFields($id))->getBody()->getContents());
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    public function findAll(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, ?\Iterator $previousResults = null): iterable
    {
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $articles = ArtikelMapper::findAll($this->connection->doRequest(ArtikelRequest::findAll($ODataRequestData)));
        $iterator = $previousResults ?? new \AppendIterator();

        if ($articles->valid()) {
            $iterator->append($articles);
        }

        if ($fetchAll && $articles->valid()) {
            if ($ODataRequestData->getSkip() === 0) {
                $ODataRequestData->setSkip(1);
            } else {
                $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
            }

            return $this->findAll($ODataRequestData, true, $iterator);
        }

        return $iterator;
    }

    public function updateArtikel(Artikel $artikel)
    {
        if ($artikel->getId() === null) {
            throw new PreValidationException("Artikel should have an ID.");
        }
        return $this->connection->doRequest(ArtikelRequest::updateArtikel($artikel));
    }
}