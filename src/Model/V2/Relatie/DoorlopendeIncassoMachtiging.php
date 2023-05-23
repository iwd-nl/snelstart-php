<?php
declare(strict_types=1);

namespace SnelstartPHP\Model\V2\Relatie;

use DateTimeImmutable;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Model\V2\Relatie;

final class DoorlopendeIncassoMachtiging extends SnelstartObject
{
    /**
     * @var string
     */
    private $kenmerk;

    /**
     * @var DateTimeImmutable
     */
    private $afsluitDatum;

    /**
     * @var string|null
     */
    private $omschrijving;

    /**
     * @var Relatie $klant
     */
    private $klant;

    /**
     * @var DateTimeImmutable|null
     */
    private $intrekkingsDatum;

    /**
     * @var string[]
     */
    public static $editableAttributes = [
        "kenmerk",
        "afsluitDatum",
        "omschrijving",
        "klant",
        "intrekkingsDatum",
    ];

    public function getKenmerk(): string
    {
        return $this->kenmerk;
    }

    public function setKenmerk(string $kenmerk): DoorlopendeIncassoMachtiging
    {
        $this->kenmerk = $kenmerk;

        return $this;
    }

    public function getAfsluitDatum(): DateTimeImmutable
    {
        return $this->afsluitDatum;
    }

    public function setAfsluitDatum(DateTimeImmutable $afsluitDatum): DoorlopendeIncassoMachtiging
    {
        $this->afsluitDatum = $afsluitDatum;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(?string $omschrijving): DoorlopendeIncassoMachtiging
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getKlant(): Relatie
    {
        return $this->klant;
    }

    public function setKlant(Relatie $klant): DoorlopendeIncassoMachtiging
    {
        $this->klant = $klant;

        return $this;
    }

    public function getIntrekkingsDatum(): ?DateTimeImmutable
    {
        return $this->intrekkingsDatum;
    }

    public function setIntrekkingsDatum(?DateTimeImmutable $intrekkingsDatum): DoorlopendeIncassoMachtiging
    {
        $this->intrekkingsDatum = $intrekkingsDatum;

        return $this;
    }
}