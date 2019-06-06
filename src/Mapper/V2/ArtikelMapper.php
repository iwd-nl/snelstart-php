<?php
/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use Money\Currency;
use Money\Money;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\V2\Artikel;
use SnelstartPHP\Model\V2\ArtikelOmzetgroep;
use SnelstartPHP\Model\V2\SubArtikel;
use SnelstartPHP\Snelstart;

final class ArtikelMapper extends AbstractMapper
{
    public static function find(ResponseInterface $response): ?Artikel
    {
        $mapper = new static($response);
        return $mapper->mapResponseToArtikelInstance(new Artikel(), $mapper->responseData);
    }

    public static function findAll(ResponseInterface $response): \Generator
    {
        $mapper = new static($response);

        foreach ($mapper->responseData as $data) {
            yield $mapper->mapResponseToArtikelInstance(new Artikel(), $data);
        }
    }

    public function mapResponseToArtikelInstance(Artikel $artikel, array $data): Artikel
    {
        /**
         * @var $artikel Artikel
         */
        $artikel = $this->mapArrayDataToModel($artikel, $data);
        $currency = new Currency(Snelstart::CURRENCY);

        if (isset($data["verkoopprijs"])) {
            $artikel->setVerkoopprijs(new Money($data["verkoopprijs"] * 100, $currency));
        }

        if (isset($data["artikelOmzetgroep"])) {
            $artikel->setArtikelOmzetgroep(ArtikelOmzetgroep::createFromUUID(Uuid::fromString($data["artikelOmzetgroep"]["id"])));
        }

        foreach ($data["subartikelen"] ?? [] as $subArtikel) {
            $artikel->addSubArtikel(SubArtikel::createFromUUID($subArtikel["id"])
                ->setAantal($subArtikel["aantal"])
                ->setArtikelcode($subArtikel["artikelcode"])
            );
        }

        return $artikel;
    }
}