<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Model\Artikel;

class ArtikelMapper extends AbstractMapper
{
    public static function find(ResponseInterface $response): ?Artikel
    {
        $mapper = new static($response);
        $result = $mapper->mapArrayDataToModel(new Artikel(), $mapper->responseData);
        return $result->setArtikelOmzetgroep($mapper->responseData['artikelOmzetgroep']);
    }

    public static function findAll(ResponseInterface $response): \Generator
    {
        $mapper = new static($response);

        foreach ($mapper->responseData as $artikelData) {
            yield $mapper->mapArrayDataToModel(new Artikel(), $artikelData);
        }
    }
}