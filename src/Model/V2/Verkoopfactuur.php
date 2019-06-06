<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\SnelstartObject;

final class Verkoopfactuur extends SnelstartObject
{
    /**
     * De verkoopboeking bij de factuur
     *
     * @var Verkoopboeking
     */
    private $verkoopBoeking;

    /**
     * Het tijdstip waarop de verkoopfactuur voor het laatst is gewijzigd.
     *
     * @var \DateTimeImmutable
     */
    private $modifiedOn;

    /**
     * Het openstaand saldo van de verkoopfactuur.\r\nDeze wordt alleen bij uitlezen gevuld
     *
     * @var Money
     */
    private $openstaandSaldo;

    /**
     * Het factuurnummer.
     *
     * @var string
     */
    private $factuurnummer;

    /**
     * Het tijdstip waarop de factuur is of zal vervallen
     *
     * @var \DateTimeImmutable
     */
    private $vervalDatum;

    /**
     * @var Relatie
     */
    private $relatie;

    /**
     * De datum waarop de factuur is aangemaakt
     *
     * @var \DateTimeImmutable
     */
    private $factuurDatum;

    /**
     * Het totaal bedrag van de factuur
     *
     * @var Money
     */
    private $factuurBedrag;

    public static $editableAttributes = [
        "verkoopBoeking",
        "openstaandSaldo",
        "factuurnummer",
        "vervalDatum",
        "relatie",
        "factuurDatum",
        "factuurBedrag",
    ];

    /**
     * @return Verkoopboeking
     */
    public function getVerkoopBoeking(): Verkoopboeking
    {
        return $this->verkoopBoeking;
    }

    /**
     * @param Verkoopboeking $verkoopBoeking
     * @return Verkoopfactuur
     */
    public function setVerkoopBoeking(Verkoopboeking $verkoopBoeking): self
    {
        $this->verkoopBoeking = $verkoopBoeking;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getModifiedOn(): \DateTimeImmutable
    {
        return $this->modifiedOn;
    }

    /**
     * @param \DateTimeImmutable $modifiedOn
     * @return Verkoopfactuur
     */
    public function setModifiedOn(\DateTimeImmutable $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    /**
     * @return Money
     */
    public function getOpenstaandSaldo(): Money
    {
        return $this->openstaandSaldo;
    }

    /**
     * @param Money $openstaandSaldo
     * @return Verkoopfactuur
     */
    public function setOpenstaandSaldo(Money $openstaandSaldo): self
    {
        $this->openstaandSaldo = $openstaandSaldo;

        return $this;
    }

    /**
     * @return string
     */
    public function getFactuurnummer(): string
    {
        return $this->factuurnummer;
    }

    /**
     * @param string $factuurnummer
     * @return Verkoopfactuur
     */
    public function setFactuurnummer(string $factuurnummer): self
    {
        $this->factuurnummer = $factuurnummer;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getVervalDatum(): \DateTimeImmutable
    {
        return $this->vervalDatum;
    }

    /**
     * @param \DateTimeImmutable $vervalDatum
     * @return Verkoopfactuur
     */
    public function setVervalDatum(\DateTimeImmutable $vervalDatum): self
    {
        $this->vervalDatum = $vervalDatum;

        return $this;
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
     * @return Verkoopfactuur
     */
    public function setRelatie(Relatie $relatie): self
    {
        $this->relatie = $relatie;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getFactuurDatum(): \DateTimeImmutable
    {
        return $this->factuurDatum;
    }

    /**
     * @param \DateTimeImmutable $factuurDatum
     * @return Verkoopfactuur
     */
    public function setFactuurDatum(\DateTimeImmutable $factuurDatum): self
    {
        $this->factuurDatum = $factuurDatum;

        return $this;
    }

    /**
     * @return Money
     */
    public function getFactuurBedrag(): Money
    {
        return $this->factuurBedrag;
    }

    /**
     * @param Money $factuurBedrag
     * @return Verkoopfactuur
     */
    public function setFactuurBedrag(Money $factuurBedrag): self
    {
        $this->factuurBedrag = $factuurBedrag;

        return $this;
    }
}