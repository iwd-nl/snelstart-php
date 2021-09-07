<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Exception\BookingNotInBalanceException;
use SnelstartPHP\Model\SnelstartObject;

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
     * De omschrijving van de boeking.
     *
     * @var string|null
     */
    protected $omschrijving;


    /**
     * @var string[]
     */
    public static $editableAttributes = [
        "id",
        "boekstuk",
        "gewijzigdDoorAccountant",
        "markering",
        "omschrijving",
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


    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(?string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }


}
