<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper;

use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Model\Boeking;
use SnelstartPHP\Model\Boekingsregel;
use SnelstartPHP\Model\Btwregel;
use SnelstartPHP\Model\Grootboek;
use SnelstartPHP\Model\IncassoMachtiging;
use SnelstartPHP\Model\Inkoopboeking;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\Relatie;
use SnelstartPHP\Model\Type\BtwRegelSoort;
use SnelstartPHP\Model\Type\BtwSoort;
use SnelstartPHP\Model\Verkoopboeking;
use SnelstartPHP\Snelstart;

class BoekingMapper extends AbstractMapper
{
    public static function findAllInkoopfacturen(ResponseInterface $response): \Generator
    {
        return (new static($response))->mapManyResultsToSubMappers(Inkoopboeking::class);
    }

    public static function findAllVerkoopfacturen(ResponseInterface $response): \Generator
    {
        return (new static($response))->mapManyResultsToSubMappers(Verkoopboeking::class);
    }

    public static function addInkoopboeking(ResponseInterface $response): Inkoopboeking
    {
        $mapper = new static($response);
        return $mapper->mapInkoopboekingResult(new Inkoopboeking(), $mapper->responseData);
    }

    public static function addVerkoopboeking(ResponseInterface $response): Verkoopboeking
    {
        $mapper = new static($response);
        return $mapper->mapVerkoopboekingResult(new Verkoopboeking(), $mapper->responseData);
    }

    public function mapInkoopboekingResult(Inkoopboeking $inkoopboeking, array $data = []): Inkoopboeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Inkoopboeking $inkoopboeking
         */
        $inkoopboeking = $this->mapBoekingResult($inkoopboeking, $data);

        if (isset($data["leverancier"])) {
            $inkoopboeking->setLeverancier(Relatie::createFromUUID(Uuid::fromString($data["leverancier"]["id"])));
        }

        return $inkoopboeking;
    }

    public function mapVerkoopboekingResult(Verkoopboeking $verkoopboeking, array $data = []): Verkoopboeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Verkoopboeking $verkoopboeking
         */
        $verkoopboeking = $this->mapBoekingResult($verkoopboeking, $data);

        if (isset($data["klant"])) {
            $verkoopboeking->setKlant(Relatie::createFromUUID(Uuid::fromString($data["klant"]["id"])));
        }

        if (isset($data["doorlopendeIncassoMachtiging"]["id"])) {
            $verkoopboeking->setDoorlopendeIncassoMachtiging(IncassoMachtiging::createFromUUID(Uuid::fromString($data["doorlopendeIncassoMachtiging"]["id"])));
        }

        if (isset($data["eenmaligeIncassoMachtiging"]["datum"])) {
            $incassomachtiging = (new IncassoMachtiging())->setDatum(new \DateTime($data["eenmaligeIncassoMachtiging"]["datum"]));

            if ($data["eenmaligeIncassoMachtiging"]["kenmerk"] !== null) {
                $incassomachtiging->setKenmerk($data["eenmaligeIncassoMachtiging"]["kenmerk"]);
            }

            if (isset($data["eenmaligeIncassoMachtiging"]["omschrijving"])) {
                $incassomachtiging->setOmschrijving($data["eenmaligeIncassoMachtiging"]["omschrijving"]);
            }

            $verkoopboeking->setEenmaligeIncassoMachtiging($incassomachtiging);
        }

        return $verkoopboeking;
    }

    public function mapBoekingResult(Boeking $boeking, array $data = []): Boeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Boeking $boeking
         */
        $boeking = $this->mapArrayDataToModel($boeking, $data);

        if (isset($data["modifiedOn"])) {
            $boeking->setModifiedOn(new \DateTimeImmutable($data["modifiedOn"]));
        }

        if (isset($data["factuurdatum"])) {
            $boeking->setFactuurdatum(new \DateTimeImmutable($data["factuurdatum"]));
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

        $boeking->setBoekingsregels($boekingsregels);

        $btwRegels = [];
        foreach ($data["btw"] ?? [] as $btw) {
            $btwRegels[] = new Btwregel(
                new BtwRegelSoort($btw["btwSoort"]),
                Snelstart::getMoneyParser()->parse((string) $btw["btwBedrag"], Snelstart::getCurrency())
            );
        }

        $boeking->setBtw($btwRegels);

        return $boeking;
    }

    public function mapManyResultsToSubMappers(string $className): \Generator
    {
        if (!in_array($className, [ Inkoopboeking::class, Verkoopboeking::class ], true)) {
            throw new \InvalidArgumentException("Unknown class name for a booking.");
        }

        foreach ($this->responseData as $boekingData) {
            if ($className === Inkoopboeking::class) {
                yield $this->mapInkoopboekingResult(new $className, $boekingData);
            } else if ($className === Verkoopboeking::class) {
                yield $this->mapVerkoopboekingResult(new $className, $boekingData);
            }
        }
    }
}