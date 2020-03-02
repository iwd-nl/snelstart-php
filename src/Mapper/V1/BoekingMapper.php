<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Mapper\V1;

use Money\Currency;
use Money\Money;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\IncassoMachtiging;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\V1 as Model;
use SnelstartPHP\Model\Type as Type;
use SnelstartPHP\Snelstart;

/**
 * @deprecated
 */
final class BoekingMapper extends AbstractMapper
{
    public static function findAllInkoopfacturen(ResponseInterface $response): \Generator
    {
        return self::fromResponse($response)->mapManyResultsToSubMappers(Model\Inkoopboeking::class);
    }

    public static function findAllVerkoopfacturen(ResponseInterface $response): \Generator
    {
        return self::fromResponse($response)->mapManyResultsToSubMappers(Model\Verkoopboeking::class);
    }

    public static function addInkoopboeking(ResponseInterface $response): Model\Inkoopboeking
    {
        return self::fromResponse($response)->mapInkoopboekingResult(new Model\Inkoopboeking());
    }

    public static function addVerkoopboeking(ResponseInterface $response): Model\Verkoopboeking
    {
        return self::fromResponse($response)->mapVerkoopboekingResult(new Model\Verkoopboeking());
    }

    public static function addBijlage(ResponseInterface $response, string $className): Model\Bijlage
    {
        return self::fromResponse($response)->mapBijlageResult(new $className);
    }

    public function mapBijlageResult(Model\Bijlage $bijlage, array $data = []): Model\Bijlage
    {
        $data = empty($data) ? $this->responseData : $data;
        $bijlage = $this->mapArrayDataToModel($bijlage, $data);

        if (isset($data["verkoopBoekingId"]) && $bijlage instanceof Model\VerkoopboekingBijlage) {
            $bijlage->setVerkoopBoekingId(Uuid::fromString($data["verkoopBoekingId"]));
        }

        if (isset($data["inkoopBoekingId"]) && $bijlage instanceof Model\InkoopboekingBijlage) {
            $bijlage->setInkoopBoekingId(Uuid::fromString($data["inkoopBoekingId"]));
        }

        return $bijlage;
    }

    public function mapInkoopboekingResult(Model\Inkoopboeking $inkoopboeking, array $data = []): Model\Inkoopboeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Model\Inkoopboeking $inkoopboeking
         */
        $inkoopboeking = $this->mapBoekingResult($inkoopboeking, $data);

        if (isset($data["leverancier"])) {
            $inkoopboeking->setLeverancier(Model\Relatie::createFromUUID(Uuid::fromString($data["leverancier"]["id"])));
        }

        return $inkoopboeking;
    }

    public function mapVerkoopboekingResult(Model\Verkoopboeking $verkoopboeking, array $data = []): Model\Verkoopboeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Model\Verkoopboeking $verkoopboeking
         */
        $verkoopboeking = $this->mapBoekingResult($verkoopboeking, $data);

        if (isset($data["klant"])) {
            $verkoopboeking->setKlant(Model\Relatie::createFromUUID(Uuid::fromString($data["klant"]["id"])));
        }

        if (isset($data["doorlopendeIncassoMachtiging"]["id"])) {
            $doorlopendeIncassoMachtiging = IncassoMachtiging::createFromUUID(Uuid::fromString($data["doorlopendeIncassoMachtiging"]["id"]));
            $verkoopboeking->setDoorlopendeIncassoMachtiging($doorlopendeIncassoMachtiging);
        }

        if (isset($data["eenmaligeIncassoMachtiging"]["datum"])) {
            $incassomachtiging = (new IncassoMachtiging())
                ->setDatum(new \DateTime($data["eenmaligeIncassoMachtiging"]["datum"]));

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

    public function mapBoekingResult(Model\Boeking $boeking, array $data = []): Model\Boeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Model\Boeking $boeking
         */
        $boeking = $this->mapArrayDataToModel($boeking, $data);

        if (isset($data["modifiedOn"])) {
            $boeking->setModifiedOn(new \DateTimeImmutable($data["modifiedOn"]));
        }

        if (isset($data["factuurDatum"])) {
            $boeking->setFactuurdatum(new \DateTimeImmutable($data["factuurDatum"]));
        }

        if (isset($data["vervalDatum"])) {
            $boeking->setVervaldatum(new \DateTimeImmutable($data["vervalDatum"]));
        }

        if (isset($data["factuurBedrag"])) {
            $boeking->setFactuurbedrag($this->getMoney($data["factuurBedrag"]));
        }

        $boekingsregels = [];
        foreach ($data["boekingsregels"] ?? [] as $boekingsregel) {
            $boekingsregelObject = (new Model\Boekingsregel())
                ->setOmschrijving($boekingsregel["omschrijving"])
                ->setGrootboek(Model\Grootboek::createFromUUID(Uuid::fromString($boekingsregel["grootboek"]["id"])))
                ->setBedrag($this->getMoney($boekingsregel["bedrag"]))
                ->setBtwSoort(new Type\BtwSoort($boekingsregel["btwSoort"]));

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
            $btwRegels[] = new Model\Btwregel(
                new Type\BtwRegelSoort($btw["btwSoort"]),
                $this->getMoney($btw["btwBedrag"])
            );
        }

        $boeking->setBtw($btwRegels);

        return $boeking;
    }

    public function mapManyResultsToSubMappers(string $className): \Generator
    {
        foreach ($this->responseData as $boekingData) {
            if ($className === Model\Inkoopboeking::class) {
                yield $this->mapInkoopboekingResult(new $className, $boekingData);
            } else if ($className === Model\Verkoopboeking::class) {
                yield $this->mapVerkoopboekingResult(new $className, $boekingData);
            }
        }
    }
}