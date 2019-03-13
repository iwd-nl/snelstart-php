<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper;

use Money\Currency;
use Money\Money;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;

use SnelstartPHP\Model\Artikel;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\Relatie;
use SnelstartPHP\Model\Type\ProcesStatus;
use SnelstartPHP\Model\Type\VerkooporderBtwIngaveModel;
use SnelstartPHP\Model\Verkoopboeking;
use SnelstartPHP\Model\VerkooporderAdres;
use SnelstartPHP\Model\VerkooporderAfleverAdres;
use SnelstartPHP\Model\VerkooporderFactuurdres;
use SnelstartPHP\Model\Land;
use SnelstartPHP\Model\RelatieAdres;
use SnelstartPHP\Model\Verkooporder;
use SnelstartPHP\Model\VerkooporderRegel;

class VerkooporderMapper extends AbstractMapper
{
    public static function find(ResponseInterface $response): ?Verkooporder
    {
        $mapper = new static($response);
        return $mapper->mapResponseToVerkooporderModel(new Verkooporder(), $mapper->responseData);

    }

    public static function findAll(ResponseInterface $response): \Generator
    {
        return (new static($response))->mapManyResultsToSubMappers();
    }

    public static function addVerkoopOrder(ResponseInterface $response): Verkooporder
    {
        $mapper = new static($response);
        return $mapper->mapResponseToVerkooporderModel(new Verkooporder, $mapper->responseData);
    }

    public static function updateVerkoopOrder(ResponseInterface $response): Verkooporder
    {
        $mapper = new static($response);
        return $mapper->mapResponseToVerkooporderModel(new Verkooporder, $mapper->responseData);
    }


    /**
     * Map the data from the response to the model.
     */
    public function mapResponseToVerkooporderModel(Verkooporder $verkooporder, array $data = []): Verkooporder
    {
        $data = empty($data) ? $this->responseData : $data;

        /**
         * @var Verkooporder $verkooporder
         */
        $verkooporder = $this->mapArrayDataToModel($verkooporder, $data);

        if (isset($data["relatie"])) {
            $verkooporder->setRelatie(Relatie::createFromUUID(Uuid::fromString($data["relatie"]["id"])));
        }

        if (isset($data["procesStatus"])) {
            $verkooporder->setProcesStatus(new ProcesStatus($data["procesStatus"]));
        }

        if (isset($data["datum"])) {
            $verkooporder->setDatum(new \DateTimeImmutable($data["datum"]));
        }

        if (isset($data["incassomachtiging"]["id"])) {
            $incassoMachtiging = Model\IncassoMachtiging::createFromUUID(Uuid::fromString($data["incassomachtiging"]["id"]));
            $verkooporder->setIncassoMachtiging($incassoMachtiging);
        }

        if (isset($data["kostenplaats"]) && strlen($data["kostenplaats"]) > 0) {
            $verkooporder->setKostenplaats(
                Kostenplaats::createFromUUID(Uuid::fromString($data["kostenplaats"]["id"]))
            );
        }

        $regels = [];
        foreach ($data["regels"] ?? [] as $regel) {
            $regelObject = (new VerkooporderRegel())
                ->setOmschrijving($regel["omschrijving"])
                ->setAantal(($regel['aantal']));

            if ($regel["artikel"]) {

                $regelObject->setArtikel(Artikel::createFromUUID(Uuid::fromString($regel["artikel"]["id"])));
            }
            if (isset($regel["stuksprijs"])) {
                $regelObject->setStuksprijs(new Money($regel["stuksprijs"] * 100, new Currency("EUR")));
            }

            if (isset($regel["kortingsPercentage"])) {
                $regelObject->setKortingsPercentage(new Money($regel["kortingsPercentage"] * 100, new Currency("EUR")));
            }


            if (isset($regel["totaal"])) {
                $regelObject->setTotaal(new Money($regel["totaal"] * 100, new Currency("EUR")));
            }


            $regels[] = $regelObject;
        }

        $verkooporder->setRegels($regels);


        if (!empty($data["afleveradres"])) {
            $verkooporder->setAfleveradres(
                static::mapAddressToVerkooporderAddress($data["afleveradres"], VerkooporderAfleverAdres::class)
            );
        }

        if (!empty($data["factuuradres"])) {
            $verkooporder->setFactuuradres(
                static::mapAddressToVerkooporderAddress($data["factuuradres"], VerkooporderFactuurdres::class)
            );
        }

        if (isset($data["verkooporderBtwIngaveModel"])) {
            $verkooporder->setVerkooporderBtwIngaveModel(new VerkooporderBtwIngaveModel($data["verkooporderBtwIngaveModel"]));
        }

        if (isset($data["factuurkorting"])) {
            $verkooporder->setFactuurKorting(new Money($data["factuurkorting"] * 100, new Currency("EUR")));
        }

        if (isset($data["verkoopfactuur"])) {
            $verkooporder->setVerkoopfactuur(
                Verkoopboeking::createFromUUID(Uuid::fromString($data["verkoopfactuur"]["id"]))
            );
        }


        return $verkooporder;
    }

    /**
     * Map the response data to the model. Should extend the RelatieAdres class.
     *
     * @param array  $address
     * @param string $addressClass
     * @return RelatieAdres
     */
    public function mapAddressToVerkooporderAddress(array $address, string $addressClass): RelatieAdres
    {
        /**
         * @var RelatieAdres $class
         */
        $class = new $addressClass;

        if (!$class instanceof VerkooporderAdres) {
            throw new \InvalidArgumentException(sprintf("Only classes that extend '%s' are allowed here.", RelatieAdres::class));
        }

        $land = Land::createFromUUID(Uuid::fromString($address["land"]["id"]));

        return $class
            ->setContactpersoon($address["contactpersoon"])
            ->setStraat($address["straat"])
            ->setPostcode($address["postcode"])
            ->setPlaats($address["plaats"])
            ->setLand($land);
    }

    /**
     * Map many results to the mapper.
     *
     * @return \Generator
     */
    protected function mapManyResultsToSubMappers(): \Generator
    {
        foreach ($this->responseData as $verkooporderData) {
            yield $this->mapResponseToVerkooporderModel(new Verkooporder(), $verkooporderData);
        }
    }
}