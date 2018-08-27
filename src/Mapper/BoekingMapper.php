<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper;

use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Model\Boekingsregel;
use SnelstartPHP\Model\Btwregel;
use SnelstartPHP\Model\Grootboek;
use SnelstartPHP\Model\Inkoopboeking;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\Relatie;
use SnelstartPHP\Model\Type\BtwRegelSoort;
use SnelstartPHP\Model\Type\BtwSoort;
use SnelstartPHP\Snelstart;

class BoekingMapper extends AbstractMapper
{
    public static function addInkoopboeking(ResponseInterface $response): Inkoopboeking
    {
        $mapper = new static($response);
        return $mapper->mapInkoopboekingResult(new Inkoopboeking(), $mapper->responseData);
    }

    public function mapInkoopboekingResult(Inkoopboeking $inkoopboeking, array $data = []): Inkoopboeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Inkoopboeking $inkoopboeking
         */
        $inkoopboeking = $this->mapArrayDataToModel($inkoopboeking, $data);

        if (isset($data["modifiedOn"])) {
            $inkoopboeking->setModifiedOn(new \DateTimeImmutable($data["modifiedOn"]));
        }

        if (isset($data["factuurdatum"])) {
            $inkoopboeking->setFactuurdatum(new \DateTimeImmutable($data["factuurdatum"]));
        }

        if (isset($data["leverancier"])) {
            $inkoopboeking->setLeverancier(Relatie::createFromUUID(Uuid::fromString($data["leverancier"]["id"])));
        }

        $boekingsregels = [];
        foreach ($data["boekingsregels"] ?? [] as $boekingsregel) {
            $boekingsregelObject = (new Boekingsregel())
                ->setOmschrijving($boekingsregel["omschrijving"])
                ->setGrootboek(Grootboek::createFromUUID(Uuid::fromString($boekingsregel["grootboek"]["id"])))
                ->setBedrag(Snelstart::getMoneyParser()->parse((string) $boekingsregel["bedrag"], Snelstart::getCurrency()))
                ->setBtwSoort(new BtwSoort($boekingsregel["btwSoort"]));

            if ($boekingsregel["kostenplaats"]) {
                $boekingsregelObject->setKostenplaats(
                    Kostenplaats::createFromUUID(Uuid::fromString($boekingsregel["kostenplaats"]["id"]))
                );
            }

            $boekingsregels[] = $boekingsregelObject;
        }

        $inkoopboeking->setBoekingsregels($boekingsregels);

        $btwRegels = [];
        foreach ($data["btw"] ?? [] as $btw) {
            $btwRegels[] = new Btwregel(
                new BtwRegelSoort($btw["btwSoort"]),
                Snelstart::getMoneyParser()->parse((string) $btw["btwBedrag"], Snelstart::getCurrency())
            );
        }

        $inkoopboeking->setBtw($btwRegels);

        return $inkoopboeking;
    }
}