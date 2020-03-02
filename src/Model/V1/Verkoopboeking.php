<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Model\V1;

use SnelstartPHP\Model\IncassoMachtiging;

/**
 * @deprecated
 */
final class Verkoopboeking extends Boeking
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

    /**
     * @var VerkoopboekingBijlage[]
     */
    protected $bijlagen;

    public static $editableAttributes = [
        "klant",
        "betalingstermijn",
        "eenmaligeIncassoMachtiging",
        "doorlopendeIncassoMachtiging",
    ];

    public static function getEditableAttributes(): array
    {
        return \array_unique(
            \array_merge(parent::$editableAttributes, parent::getEditableAttributes(), static::$editableAttributes, self::$editableAttributes)
        );
    }

    public function getKlant(): ?Relatie
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