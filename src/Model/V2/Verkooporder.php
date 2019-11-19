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
     * @var Relatie
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
     * @var \DateTimeImmutable
     */
    private $modifiedOn;

    /**
     * De orderdatum.
     *
     * @var \DateTimeImmutable
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
     * @var string
     */
    private $omschrijving;

    /**
     * Het betalingskenmerk van de order.
     *
     * @var string
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
     * @var Adres
     */
    private $afleveradres;

    /**
     * Een container voor adres informatie.
     *
     * @var Adres
     */
    private $factuuradres;

    /**
     * @var VerkooporderBtwIngave
     */
    private $verkooporderBtwIngaveModel;

    /**
     * @var Kostenplaats|null
     */
    private $kostenplaats;

    /**
     * @var VerkooporderRegel[]|iterable
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
     * @var Verkoopordersjabloon
     */
    private $verkoopordersjabloon;

    /**
     * @var Money
     */
    private $totaalExclusiefBtw;

    /**
     * @var Money
     */
    private $totaalInclusiefBtw;

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

    /**
     * @return Relatie
     */
    public function getRelatie(): Relatie
    {
        return $this->relatie;
    }

    /**
     * @param Relatie $relatie
     * @return Verkooporder
     */
    public function setRelatie(Relatie $relatie): self
    {
        $this->relatie = $relatie;

        return $this;
    }

    public function getProcesStatus(): ProcesStatus
    {
        return $this->procesStatus;
    }

    /**
     * @param ProcesStatus $procesStatus
     * @return Verkooporder
     */
    public function setProcesStatus(ProcesStatus $procesStatus): self
    {
        $this->procesStatus = $procesStatus;

        return $this;
    }

    /**
     * @return int
     */
    public function getNummer(): ?int
    {
        return $this->nummer;
    }

    /**
     * @param int $nummer
     * @return Verkooporder
     */
    public function setNummer(int $nummer): self
    {
        $this->nummer = $nummer;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getModifiedOn(): ?\DateTimeImmutable
    {
        return $this->modifiedOn;
    }

    /**
     * @param \DateTimeImmutable $modifiedOn
     * @return Verkooporder
     */
    public function setModifiedOn(\DateTimeImmutable $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDatum(): \DateTimeImmutable
    {
        return $this->datum;
    }

    /**
     * @param \DateTimeImmutable $datum
     * @return Verkooporder
     */
    public function setDatum(\DateTimeImmutable $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * @return int
     */
    public function getKrediettermijn(): ?int
    {
        return $this->krediettermijn;
    }

    /**
     * @param int $krediettermijn
     * @return Verkooporder
     */
    public function setKrediettermijn(int $krediettermijn): self
    {
        $this->krediettermijn = $krediettermijn;

        return $this;
    }

    /**
     * @return string
     */
    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    /**
     * @param string $omschrijving
     * @return Verkooporder
     */
    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    /**
     * @return string
     */
    public function getBetalingskenmerk(): ?string
    {
        return $this->betalingskenmerk;
    }

    /**
     * @param string $betalingskenmerk
     * @return Verkooporder
     */
    public function setBetalingskenmerk(string $betalingskenmerk): self
    {
        $this->betalingskenmerk = $betalingskenmerk;

        return $this;
    }

    /**
     * @return IncassoMachtiging|null
     */
    public function getIncassomachtiging(): ?IncassoMachtiging
    {
        return $this->incassomachtiging;
    }

    /**
     * @param IncassoMachtiging|null $incassomachtiging
     * @return Verkooporder
     */
    public function setIncassomachtiging(?IncassoMachtiging $incassomachtiging): self
    {
        $this->incassomachtiging = $incassomachtiging;

        return $this;
    }

    /**
     * @return Adres
     */
    public function getAfleveradres(): ?Adres
    {
        return $this->afleveradres;
    }

    /**
     * @param Adres $afleveradres
     * @return Verkooporder
     */
    public function setAfleveradres(Adres $afleveradres): self
    {
        $this->afleveradres = $afleveradres;

        return $this;
    }

    /**
     * @return Adres
     */
    public function getFactuuradres(): ?Adres
    {
        return $this->factuuradres;
    }

    /**
     * @param Adres $factuuradres
     * @return Verkooporder
     */
    public function setFactuuradres(Adres $factuuradres): self
    {
        $this->factuuradres = $factuuradres;

        return $this;
    }

    public function getVerkooporderBtwIngaveModel(): VerkooporderBtwIngave
    {
        return $this->verkooporderBtwIngaveModel;
    }

    public function setVerkooporderBtwIngaveModel(VerkooporderBtwIngave $verkooporderBtwIngaveModel): self
    {
        $this->verkooporderBtwIngaveModel = $verkooporderBtwIngaveModel;

        return $this;
    }

    /**
     * @return Kostenplaats|null
     */
    public function getKostenplaats(): ?Kostenplaats
    {
        return $this->kostenplaats;
    }

    /**
     * @param Kostenplaats|null $kostenplaats
     * @return Verkooporder
     */
    public function setKostenplaats(?Kostenplaats $kostenplaats): self
    {
        $this->kostenplaats = $kostenplaats;

        return $this;
    }

    /**
     * @return iterable|VerkooporderRegel[]
     */
    public function getRegels()
    {
        return $this->regels;
    }

    public function setRegels(VerkooporderRegel ...$regels): self
    {
        $this->regels = $regels;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMemo(): ?string
    {
        return $this->memo;
    }

    /**
     * @param string|null $memo
     * @return Verkooporder
     */
    public function setMemo(?string $memo): self
    {
        $this->memo = $memo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrderreferentie(): ?string
    {
        return $this->orderreferentie;
    }

    /**
     * @param string|null $orderreferentie
     * @return Verkooporder
     */
    public function setOrderreferentie(?string $orderreferentie): self
    {
        $this->orderreferentie = $orderreferentie;

        return $this;
    }

    /**
     * @return Money|null
     */
    public function getFactuurkorting(): ?Money
    {
        return $this->factuurkorting;
    }

    /**
     * @param Money|null $factuurkorting
     * @return Verkooporder
     */
    public function setFactuurkorting(?Money $factuurkorting): self
    {
        $this->factuurkorting = $factuurkorting;

        return $this;
    }

    /**
     * @return Verkoopfactuur|null
     */
    public function getVerkoopfactuur(): ?Verkoopfactuur
    {
        return $this->verkoopfactuur;
    }

    /**
     * @param Verkoopfactuur|null $verkoopfactuur
     * @return Verkooporder
     */
    public function setVerkoopfactuur(?Verkoopfactuur $verkoopfactuur): self
    {
        $this->verkoopfactuur = $verkoopfactuur;

        return $this;
    }

    /**
     * @return Verkoopordersjabloon
     */
    public function getVerkoopordersjabloon(): ?Verkoopordersjabloon
    {
        return $this->verkoopordersjabloon;
    }

    /**
     * @param Verkoopordersjabloon $verkoopordersjabloon
     * @return Verkooporder
     */
    public function setVerkoopordersjabloon(Verkoopordersjabloon $verkoopordersjabloon): self
    {
        $this->verkoopordersjabloon = $verkoopordersjabloon;

        return $this;
    }

    /**
     * @return Money
     */
    public function getTotaalExclusiefBtw(): ?Money
    {
        return $this->totaalExclusiefBtw ?? new Money("0", Snelstart::getCurrency());
    }

    /**
     * @param Money $totaalExclusiefBtw
     * @return Verkooporder
     */
    public function setTotaalExclusiefBtw(Money $totaalExclusiefBtw): self
    {
        $this->totaalExclusiefBtw = $totaalExclusiefBtw;

        return $this;
    }

    /**
     * @return Money
     */
    public function getTotaalInclusiefBtw(): ?Money
    {
        return $this->totaalInclusiefBtw ?? new Money("0", Snelstart::getCurrency());
    }

    /**
     * @param Money $totaalInclusiefBtw
     * @return Verkooporder
     */
    public function setTotaalInclusiefBtw(Money $totaalInclusiefBtw): self
    {
        $this->totaalInclusiefBtw = $totaalInclusiefBtw;

        return $this;
    }
}