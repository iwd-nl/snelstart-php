<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Model\V1;

use Money\Money;
use SnelstartPHP\Exception\BookingNotInBalanceException;
use SnelstartPHP\Model\SnelstartObject;

/**
 * @deprecated
 */
abstract class Boeking extends SnelstartObject
{
    /**
     * Het tijdstip waarop het grootboek is aangemaakt of voor het laatst is gewijzigd
     *
     * @var \DateTimeInterface|null
     */
    protected $modifiedOn;

    /**
     * Het boekstuknummer van de boeking.
     *
     * @var string|null
     */
    protected $boekstuk;

    /**
     * Geeft aan of deze boeking is aangepast door de accountant.
     *
     * @var bool
     */
    protected $gewijzigdDoorAccountant = false;

    /**
     * Deze boeking verdient speciale aandacht, in SnelStart wordt dit visueel benadrukt.
     *
     * @var bool
     */
    protected $markering = false;

    /**
     * De datum van de factuur, dit is ook de datum waarop de boeking wordt geboekt.
     *
     * @var \DateTimeInterface|null
     */
    protected $factuurDatum;

    /**
     * Het tijdstip waarop de factuur is of zal vervallen
     *
     * @var \DateTimeInterface|null
     */
    protected $vervalDatum;

    /**
     * De factuurnummer van de boeking.
     *
     * @var string
     */
    protected $factuurnummer;

    /**
     * De omschrijving van de boeking.
     *
     * @var string|null
     */
    protected $omschrijving;

    /**
     * @var Money
     */
    protected $factuurbedrag;

    /**
     * De omzetregels van de boeking. De btw-bedragen staan hier niet in,
     * deze staan in de Btw-collectie.
     *
     * @see Boekingsregel
     * @var Boekingsregel[]
     */
    protected $boekingsregels;

    /**
     * De af te dragen btw van de boeking per btw-tarief
     *
     * @see Btwregel
     * @var Btwregel[]
     */
    protected $btw;

    /**
     * @var string
     */
    protected $bijlagenUri;

    /**
     * @var Bijlage[]
     */
    protected $bijlagen;

    public static $editableAttributes = [
        "id",
        "boekstuk",
        "gewijzigdDoorAccountant",
        "markering",
        "factuurDatum",
        "factuurnummer",
        "omschrijving",
        "factuurBedrag",
        "boekingsregels",
        "vervalDatum",
        "btw",
    ];

    public function getModifiedOn(): ?\DateTimeInterface
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(?\DateTimeInterface $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getBoekstuk(): ?string
    {
        return $this->boekstuk;
    }

    public function setBoekstuk(?string $boekstuk): self
    {
        $this->boekstuk = $boekstuk;

        return $this;
    }

    public function isGewijzigdDoorAccountant(): bool
    {
        return $this->gewijzigdDoorAccountant;
    }

    public function setGewijzigdDoorAccountant(bool $gewijzigdDoorAccountant): self
    {
        $this->gewijzigdDoorAccountant = $gewijzigdDoorAccountant;

        return $this;
    }

    public function isMarkering(): bool
    {
        return $this->markering;
    }

    public function setMarkering(bool $markering): self
    {
        $this->markering = $markering;

        return $this;
    }

    public function getFactuurdatum(): ?\DateTimeInterface
    {
        return $this->factuurDatum;
    }

    public function setFactuurdatum(?\DateTimeInterface $factuurDatum): self
    {
        $this->factuurDatum = $factuurDatum;

        return $this;
    }

    public function getVervaldatum(): ?\DateTimeInterface
    {
        return $this->vervalDatum;
    }

    public function setVervaldatum(?\DateTimeInterface $vervalDatum): self
    {
        $this->vervalDatum = $vervalDatum;

        return $this;
    }

    public function getFactuurnummer(): string
    {
        return $this->factuurnummer;
    }

    public function setFactuurnummer(string $factuurnummer): self
    {
        $this->factuurnummer = $factuurnummer;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(?string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getFactuurbedrag(): Money
    {
        return $this->factuurbedrag;
    }

    public function setFactuurbedrag(Money $factuurbedrag): self
    {
        $this->factuurbedrag = $factuurbedrag;

        return $this;
    }

    public function getBoekingsregels(): array
    {
        return $this->boekingsregels;
    }

    public function setBoekingsregels(array $boekingsregels): self
    {
        foreach ($boekingsregels as $boekingsregel) {
            if (!$boekingsregel instanceof Boekingsregel) {
                throw new \InvalidArgumentException(sprintf("Should be a type of '%s'", Boekingsregel::class));
            }
        }

        $this->boekingsregels = $boekingsregels;

        return $this;
    }

    public function getBijlagenUri(): ?string
    {
        return $this->bijlagenUri;
    }

    public function setBijlagenUri(string $bijlagenUri): self
    {
        $this->bijlagenUri = $bijlagenUri;

        return $this;
    }

    public function getBtw(): array
    {
        return $this->btw ?? [];
    }

    public function setBtw(array $btw): self
    {
        foreach ($btw as $btwRegel) {
            if (!$btwRegel instanceof Btwregel) {
                throw new \InvalidArgumentException(sprintf("Should be a type of '%s'", Btwregel::class));
            }
        }

        $this->btw = $btw;

        return $this;
    }

    public function addBijlage(Bijlage $bijlage): self
    {
        $this->bijlagen[] = $bijlage;

        return $this;
    }

    public function assertInBalance(): void
    {
        $targetAmount = $this->getFactuurbedrag();

        /**
         * @var Boekingsregel $boekingsregel
         */
        foreach ($this->getBoekingsregels() as $boekingsregel) {
            $targetAmount->subtract($boekingsregel->getBedrag());
        }

        if ($targetAmount->isZero()) {
            throw new BookingNotInBalanceException();
        }
    }
}