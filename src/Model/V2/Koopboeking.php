<?php

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Exception\BookingNotInBalanceException;

abstract class Koopboeking extends Boeking
{

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
     * @var Btwregel[]|null
     */
    protected $btw;

    /**
     * @var Document[]
     */
    protected $documents = [];
    /**
     * @var string[]
     */
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
        "documents",
    ];
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

    public function setBoekingsregels(Boekingsregel ...$boekingsregels): self
    {
        $this->boekingsregels = $boekingsregels;

        return $this;
    }

    public function getBtw(): array
    {
        return $this->btw ?? [];
    }

    public function setBtw(Btwregel ...$btw): self
    {
        $this->btw = $btw;

        return $this;
    }

    public function getDocuments(): array
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        $this->documents[] = $document;

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
