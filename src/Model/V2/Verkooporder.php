<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\Adres;
use SnelstartPHP\Model\IncassoMachtiging;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Model\Type\ProcesStatus;
use SnelstartPHP\Model\Type\VerkooporderBtwIngave;
use SnelstartPHP\Snelstart;

final class Verkooporder extends SnelstartObject
{
    /**
     * @var Relatie|null
     */
    private $relatie;

    /**
     * Status van de order. Als deze niet is opgegeven wordt de default waarde order gebruikt. Contantbon en Factuur zijn niet beschikbaar
     *
     * @var ProcesStatus|null
     */
    private $procesStatus;

    /**
     * Het ordernummer.
     *
     * @var int|null
     */
    private $nummer;

    /**
     * Het tijdstip waarop de verkooporder voor het laatst is gewijzigd.
     *
     * @var \DateTimeImmutable|null
     */
    private $modifiedOn;

    /**
     * De orderdatum.
     *
     * @var \DateTimeImmutable|null
     */
    private $datum;

    /**
     * De krediettermijn (in dagen) van de verkooporder.
     * Indien dit veld leeg is dan wordt het krediettermijn van de klant gebruikt.
     *
     * @var int|null
     */
    private $krediettermijn;

    /**
     * De omschrijving van de order.
     *
     * @var string|null
     */
    private $omschrijving;

    /**
     * Het betalingskenmerk van de order.
     *
     * @var string|null
     */
    private $betalingskenmerk;

    /**
     * De incassomachtiging.
     *
     * @var IncassoMachtiging|null
     */
    private $incassomachtiging;

    /**
     * Het afleveradres
     *
     * @var Adres|null
     */
    private $afleveradres;

    /**
     * Een container voor adres informatie.
     *
     * @var Adres|null
     */
    private $factuuradres;

    /**
     * @var VerkooporderBtwIngave|null
     */
    private $verkooporderBtwIngaveModel;

    /**
     * @var Kostenplaats|null
     */
    private $kostenplaats;

    /**
     * @var VerkooporderRegel[]|null
     */
    private $regels;

    /**
     * @var string|null
     */
    private $memo;

    /**
     * De orderreferentie van een verkooporder. Deze wordt in de e-factuur en in de factuur als PDF opgenomen
     *
     * @var string|null
     */
    private $orderreferentie;

    /**
     * @var Money|null
     */
    private $factuurkorting;

    /**
     * Verkoopfactuur identifier
     *
     * @var Verkoopfactuur|null
     */
    private $verkoopfactuur;

    /**
     * Het te gebruiken sjaboon voor deze verkooporden. Dit veld is optioneel
     *
     * @var Verkoopordersjabloon|null
     */
    private $verkoopordersjabloon;

    /**
     * @var Money|null
     */
    private $totaalExclusiefBtw;

    /**
     * @var Money|null
     */
    private $totaalInclusiefBtw;

    /**
     * @var string[]
     */
    public static $editableAttributes = [
        "relatie",
        "procesStatus",
        "nummer",
        "modifiedOn",
        "datum",
        "krediettermijn",
        "omschrijving",
        "betalingskenmerk",
        "incassomachtiging",
        "afleveradres",
        "factuuradres",
        "verkooporderBtwIngaveModel",
        "kostenplaats",
        "regels",
        "memo",
        "orderreferentie",
        "factuurkorting",
        "verkoopfactuur",
        "verkoopordersjabloon",
        "totaalExclusiefBtw",
        "totaalInclusiefBtw",
    ];

    public static function getEditableAttributes(): array
    {
        return \array_unique(
            \array_merge(parent::$editableAttributes, parent::getEditableAttributes(), static::$editableAttributes, self::$editableAttributes)
        );
    }

    public function getRelatie(): ?Relatie
    {
        return $this->relatie;
    }

    public function setRelatie(Relatie $relatie): self
    {
        $this->relatie = $relatie;

        return $this;
    }

    public function getProcesStatus(): ?ProcesStatus
    {
        return $this->procesStatus;
    }

    public function setProcesStatus(ProcesStatus $procesStatus): self
    {
        $this->procesStatus = $procesStatus;

        return $this;
    }

    public function getNummer(): ?int
    {
        return $this->nummer;
    }

    public function setNummer(int $nummer): self
    {
        $this->nummer = $nummer;

        return $this;
    }

    public function getModifiedOn(): ?\DateTimeImmutable
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(\DateTimeImmutable $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getDatum(): ?\DateTimeImmutable
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeImmutable $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getKrediettermijn(): ?int
    {
        return $this->krediettermijn;
    }

    public function setKrediettermijn(int $krediettermijn): self
    {
        $this->krediettermijn = $krediettermijn;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getBetalingskenmerk(): ?string
    {
        return $this->betalingskenmerk;
    }

    public function setBetalingskenmerk(string $betalingskenmerk): self
    {
        $this->betalingskenmerk = $betalingskenmerk;

        return $this;
    }

    public function getIncassomachtiging(): ?IncassoMachtiging
    {
        return $this->incassomachtiging;
    }

    public function setIncassomachtiging(?IncassoMachtiging $incassomachtiging): self
    {
        $this->incassomachtiging = $incassomachtiging;

        return $this;
    }

    public function getAfleveradres(): ?Adres
    {
        return $this->afleveradres;
    }

    public function setAfleveradres(Adres $afleveradres): self
    {
        $this->afleveradres = $afleveradres;

        return $this;
    }

    public function getFactuuradres(): ?Adres
    {
        return $this->factuuradres;
    }

    public function setFactuuradres(Adres $factuuradres): self
    {
        $this->factuuradres = $factuuradres;

        return $this;
    }

    public function getVerkooporderBtwIngaveModel(): ?VerkooporderBtwIngave
    {
        return $this->verkooporderBtwIngaveModel;
    }

    public function setVerkooporderBtwIngaveModel(VerkooporderBtwIngave $verkooporderBtwIngaveModel): self
    {
        $this->verkooporderBtwIngaveModel = $verkooporderBtwIngaveModel;

        return $this;
    }

    public function getKostenplaats(): ?Kostenplaats
    {
        return $this->kostenplaats;
    }

    public function setKostenplaats(?Kostenplaats $kostenplaats): self
    {
        $this->kostenplaats = $kostenplaats;

        return $this;
    }

    /**
     * @return VerkooporderRegel[]
     */
    public function getRegels(): ?iterable
    {
        return $this->regels;
    }

    public function setRegels(VerkooporderRegel ...$regels): self
    {
        $this->regels = $regels;

        return $this;
    }

    public function getMemo(): ?string
    {
        return $this->memo;
    }

    public function setMemo(?string $memo): self
    {
        $this->memo = $memo;

        return $this;
    }

    public function getOrderreferentie(): ?string
    {
        return $this->orderreferentie;
    }

    public function setOrderreferentie(?string $orderreferentie): self
    {
        $this->orderreferentie = $orderreferentie;

        return $this;
    }

    public function getFactuurkorting(): ?Money
    {
        return $this->factuurkorting;
    }

    public function setFactuurkorting(?Money $factuurkorting): self
    {
        $this->factuurkorting = $factuurkorting;

        return $this;
    }

    public function getVerkoopfactuur(): ?Verkoopfactuur
    {
        return $this->verkoopfactuur;
    }

    public function setVerkoopfactuur(?Verkoopfactuur $verkoopfactuur): self
    {
        $this->verkoopfactuur = $verkoopfactuur;

        return $this;
    }

    public function getVerkoopordersjabloon(): ?Verkoopordersjabloon
    {
        return $this->verkoopordersjabloon;
    }

    public function setVerkoopordersjabloon(Verkoopordersjabloon $verkoopordersjabloon): self
    {
        $this->verkoopordersjabloon = $verkoopordersjabloon;

        return $this;
    }

    public function getTotaalExclusiefBtw(): ?Money
    {
        return $this->totaalExclusiefBtw ?? new Money("0", Snelstart::getCurrency());
    }

    public function setTotaalExclusiefBtw(Money $totaalExclusiefBtw): self
    {
        $this->totaalExclusiefBtw = $totaalExclusiefBtw;

        return $this;
    }

    public function getTotaalInclusiefBtw(): ?Money
    {
        return $this->totaalInclusiefBtw ?? new Money("0", Snelstart::getCurrency());
    }

    public function setTotaalInclusiefBtw(Money $totaalInclusiefBtw): self
    {
        $this->totaalInclusiefBtw = $totaalInclusiefBtw;

        return $this;
    }
}