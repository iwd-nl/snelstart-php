<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

class Verkoopboeking extends Boeking
{
    /**
     * De klant/debiteur aan wie de factuur is gericht.
     *
     * @var Relatie
     */
    private $klant;

    /**
     * De betalingstermijn (in dagen) van de verkoopboeking.
     *
     * @var int|null
     */
    private $betalingstermijn;

    /**
     * De (optionele) eenmalige incassomachtiging waarmee deze factuur kan worden geïncasseerd.
     *
     * @var IncassoMachtiging|null
     */
    private $eenmaligeIncassoMachtiging;

    /**
     * De (optionele) doorlopende incassomachtiging waarmee deze factuur kan worden geïncasseerd.
     *
     * @var IncassoMachtiging|null
     */
    private $doorlopendeIncassoMachtiging;

    public static $editableAttributes = [
        "klant",
        "boekstuk",
        "gewijzigdDoorAccountant",
        "markering",
        "factuurdatum",
        "factuurnummer",
        "omschrijving",
        "factuurbedrag",
        "boekingsregels",
        "btw",
        "betalingstermijn",
        "eenmaligeIncassoMachtiging",
        "doorlopendeIncassoMachtiging",
    ];

    public function getKlant(): Relatie
    {
        return $this->klant;
    }

    public function setKlant(Relatie $klant): self
    {
        $this->klant = $klant;

        return $this;
    }

    public function getBetalingstermijn(): ?int
    {
        return $this->betalingstermijn;
    }

    public function setBetalingstermijn(int $betalingstermijn): self
    {
        $this->betalingstermijn = $betalingstermijn;

        return $this;
    }

    public function getEenmaligeIncassoMachtiging(): ?IncassoMachtiging
    {
        return $this->eenmaligeIncassoMachtiging;
    }

    public function setEenmaligeIncassoMachtiging(?IncassoMachtiging $eenmaligeIncassoMachtiging): self
    {
        $this->eenmaligeIncassoMachtiging = $eenmaligeIncassoMachtiging;

        return $this;
    }

    public function getDoorlopendeIncassoMachtiging(): ?IncassoMachtiging
    {
        return $this->doorlopendeIncassoMachtiging;
    }

    public function setDoorlopendeIncassoMachtiging(?IncassoMachtiging $doorlopendeIncassoMachtiging): self
    {
        $this->doorlopendeIncassoMachtiging = $doorlopendeIncassoMachtiging;

        return $this;
    }
}