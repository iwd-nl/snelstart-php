<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Connector\V2;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Connector\BaseConnector;
use SnelstartPHP\Exception\SnelstartResourceNotFoundException;
use SnelstartPHP\Mapper\V2 as Mapper;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Request\ODataRequestData;
use SnelstartPHP\Request\V2 as Request;

final class ArtikelConnector extends BaseConnector
{
    public function find(UuidInterface $id, ?ODataRequestData $ODataRequestData = null, ?Model\Relatie $relatie = null, ?int $aantal = null): ?Model\Artikel
    {
        $artikelRequest = new Request\ArtikelRequest();
        $artikelMapper = new Mapper\ArtikelMapper();
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();

        try {
            return $artikelMapper->find($this->connection->doRequest($artikelRequest->find($id, $ODataRequestData, $relatie, $aantal)));
        } catch (SnelstartResourceNotFoundException $e) {
            return null;
        }
    }

    /**
     * @return Model\Artikel[]|iterable
     */
    public function findAll(?ODataRequestData $ODataRequestData = null, bool $fetchAll = false, iterable $previousResults = null, ?Model\Relatie $relatie = null, ?int $aantal = null): iterable
    {
        $artikelRequest = new Request\ArtikelRequest();
        $artikelMapper = new Mapper\ArtikelMapper();
        $ODataRequestData = $ODataRequestData ?? new ODataRequestData();
        $artikelen = $artikelMapper->findAll($this->connection->doRequest($artikelRequest->findAll($ODataRequestData, $relatie, $aantal)));
        $iterator = $previousResults ?? new \AppendIterator();

        if ($iterator instanceof \AppendIterator && $artikelen->valid()) {
            $iterator->append($artikelen);
        }

        if ($fetchAll && $artikelen->valid()) {
            if ($previousResults === null) {
                $ODataRequestData->setSkip($ODataRequestData->getTop());
            } else {
                $ODataRequestData->setSkip($ODataRequestData->getSkip() + $ODataRequestData->getTop());
            }

            return $this->findAll($ODataRequestData, true, $iterator, $relatie, $aantal);
        }

        return $iterator;
    }
}