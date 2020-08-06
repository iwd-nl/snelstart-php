<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Mapper\V2;

use function array_map;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\IncassoMachtiging;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Model\Type as Type;

final class BoekingMapper extends AbstractMapper
{
    public function findInkoopboeking(ResponseInterface $response): Model\Inkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapInkoopboekingResult(new Model\Inkoopboeking());
    }

    public function findVerkoopboeking(ResponseInterface $response): Model\Verkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapVerkoopboekingResult(new Model\Verkoopboeking());
    }

    public function findAllInkoopboekingen(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);
        return $this->mapManyResultsToSubMappers(Model\Inkoopboeking::class);
    }

    public function findAllVerkoopboekingen(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);
        return $this->mapManyResultsToSubMappers(Model\Verkoopboeking::class);
    }

    public function addInkoopboeking(ResponseInterface $response): Model\Inkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapInkoopboekingResult(new Model\Inkoopboeking());
    }

    public function addVerkoopboeking(ResponseInterface $response): Model\Verkoopboeking
    {
        $this->setResponseData($response);
        return $this->mapVerkoopboekingResult(new Model\Verkoopboeking());
    }

    protected function mapDocumentResult(array $data = []): Model\Document
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Model\Document $document
         */
        $document = $this->mapArrayDataToModel(new Model\Document(), $data);

        return $document;
    }

    protected function mapInkoopboekingResult(Model\Inkoopboeking $inkoopboeking, array $data = []): Model\Inkoopboeking
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

    protected function mapVerkoopboekingResult(Model\Verkoopboeking $verkoopboeking, array $data = []): Model\Verkoopboeking
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Model\Verkoopboeking $verkoopboeking
         */
        $verkoopboeking = $this->mapBoekingResult($verkoopboeking, $data);

        if (isset($data["klant"])) {
            $verkoopboeking->setKlant(Model\Relatie::createFromUUID(Uuid::fromString($data["klant"]["id"])));
        } else if (isset($data["relatie"])) {
            $verkoopboeking->setKlant(Model\Relatie::createFromUUID(Uuid::fromString($data["relatie"]["id"])));
        }

        if (isset($data["doorlopendeIncassoMachtiging"]["id"])) {
            $doorlopendeIncassoMachtiging = IncassoMachtiging::createFromUUID(Uuid::fromString($data["doorlopendeIncassoMachtiging"]["id"]));
            $verkoopboeking->setDoorlopendeIncassoMachtiging($doorlopendeIncassoMachtiging);
        }

        if (isset($data["eenmaligeIncassoMachtiging"]["datum"])) {
            $incassomachtiging = (new IncassoMachtiging())
                ->setDatum(new \DateTimeImmutable($data["eenmaligeIncassoMachtiging"]["datum"]));

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

    protected function mapBoekingResult(Model\Boeking $boeking, array $data = []): Model\Boeking
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

        if (isset($data["boekingsregels"])) {
            $boeking->setBoekingsregels(...array_map(function(array $boekingsregel): Model\Boekingsregel {
                $boekingsregelObject = (new Model\Boekingsregel())
                    ->setOmschrijving($boekingsregel["omschrijving"])
                    ->setBedrag($this->getMoney($boekingsregel["bedrag"]))
                    ->setBtwSoort(new Type\BtwSoort($boekingsregel["btwSoort"]));

                if (isset($boekingsregel["grootboek"])) {
                    $boekingsregelObject
                        ->setGrootboek(Model\Grootboek::createFromUUID(Uuid::fromString($boekingsregel["grootboek"]["id"])));
                }

                if (isset($boekingsregel["kostenplaats"])) {
                    $boekingsregelObject->setKostenplaats(
                        Kostenplaats::createFromUUID(Uuid::fromString($boekingsregel["kostenplaats"]["id"]))
                    );
                }

                return $boekingsregelObject;
            }, $data["boekingsregels"]));
        }

        if (isset($data["btw"])) {
            $boeking->setBtw(...array_map(function(array $btw): Model\Btwregel {
                return new Model\Btwregel(
                    new Type\BtwRegelSoort($btw["btwSoort"]),
                    $this->getMoney($btw["btwBedrag"])
                );
            }, $data["btw"]));
        }

        if (isset($data["documents"])) {
            foreach ($data["documents"] as $document) {
                $boeking->addDocument($this->mapDocumentResult($document));
            }

        }

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