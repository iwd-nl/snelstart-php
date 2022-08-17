<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

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
     * De omzetregels van de boeking. De btw-bedragen staan hier niet in,
     * deze staan in de Btw-collectie.
     *
     * @see Boekingsregel
     * @var Boekingsregel[]
     */
    protected $boekingsregels = [];

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
}
