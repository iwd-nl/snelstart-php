<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Money\Money;

class Artikel extends SnelstartObject
{
    /**
     * @var bool
     */
    private $isHoofdartikel;

    /**
     * @var []
     */
    private $subArtikelen;

    /**
     * @var string
     */
    private $artikelcode;

    /**
     * @var string
     */
    private $omschrijving;

    /**
     * @var array
     */
    private $artikelOmzetgroep;

    /**
     * @var Money|null $verkoopprijs
     */
    private $verkoopprijs;

    /**
     * Datum waarop de gegevens van dit artikel zijn aangepast
     *
     * @var \DateTimeInterface|null
     */
    private $modifiedOn;

    /**
     * @var bool
     */
    private $isNonActief;

    /**
     * @var bool
     */
    private $voorraadControle;

    /**
     * @var int
     */
    private $technischeVoorraad;

    /**
     * @var int
     */
    private $vrijeVoorraad;

    /**
     * @var array
     */
    private $prijsafspraak;


    public static $editableAttributes = [
        'id',
        'isHoofdartikel',
        'subArtikelen',
        'artikelcode',
        'omschrijving',
        'artikelOmzetgroep',
        'verkoopprijs',
        'modifiedOn',
        'isNonActief',
        'voorraadControle',
        'technischeVoorraad',
        'vrijeVoorraad',
        'prijsafspraak',
    ];

    /**
     * @return \DateTimeInterface|null
     */
    public function getModifiedOn(): ?\DateTimeInterface
    {
        return $this->modifiedOn;
    }

    /**
     * @param \DateTimeInterface|null $modifiedOn
     * @return Artikel
     */
    public function setModifiedOn(?\DateTimeInterface $modifiedOn): self
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsHoofdartikel(): bool
    {
        return $this->isHoofdartikel;
    }

    /**
     * @param bool isHoofdartikel
     * @return Artikel
     */
    public function setIsHoofdartikel(bool $isHoofdartikel): self
    {
        $this->isHoofdartikel = $isHoofdartikel;

        return $this;
    }

    /**
     * @return null|array
     */
    public function getSubArtikelen(): ?array
    {
        return $this->subArtikelen;
    }

    /**
     * @param array|null $subArtikelen
     * @return Artikel
     */
    public function setSubArtikelen(?array $subArtikelen): self {
        $this->subArtikelen = $subArtikelen;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getArtikelcode(): ?string
    {
        return $this->artikelcode;
    }

    /**
     * @param null|string $artikelcode
     * @return Relatie
     */
    public function setArtikelcode(?string $artikelcode): self
    {
        $this->artikelcode = $artikelcode;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    /**
     * @param null|string $artikelcode
     * @return Artikel
     */
    public function setOmschrijving(?string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    /**
     * @return null|array
     */
    public function getArtikelOmzetgroep(): ?array
    {
        return $this->artikelOmzetgroep;
    }

    /**
     * @param array|null $artikelomzetgroep
     * @return Artikel
     */
    public function setArtikelOmzetgroep(?array $artikelOmzetgroep): self {
        $this->artikelOmzetgroep = $artikelOmzetgroep;

        return $this;
    }

    /**
     * @return Money|null
     */
    public function getVerkoopprijs(): ?Money
    {
        return $this->verkoopprijs;
    }

    /**
     * @param Money|null $verkoopprijs
     * @return Artikel
     */
    public function setVerkoopprijs(?Money $verkoopprijs): self
    {
        $this->verkoopprijs = $verkoopprijs;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsNonActief(): bool
    {
        return $this->isNonActief;
    }

    /**
     * @param bool $isNonActief
     * @return Artikel
     */
    public function setIsNonActief(bool $isNonActief): self
    {
        $this->isNonActief = $isNonActief;

        return $this;
    }

    /**
     * @return bool
     */
    public function getVoorraadControle(): bool
    {
        return $this->voorraadControle;
    }

    /**
     * @param bool $voorraadControle
     * @return Artikel
     */
    public function setVoorraadControle(bool $voorraadControle): self
    {
        $this->voorraadControle = $voorraadControle;

        return $this;
    }

    /**
     * @return int
     */
    public function getTechnischeVoorraad(): int
    {
        return $this->technischeVoorraad;
    }

    /**
     * @param int $technischeVoorraad
     * @return Artikel
     */
    public function setTechnischeVoorraad(?int $technischeVoorraad): self
    {
        $this->technischeVoorraad = $technischeVoorraad ?? $this->technischeVoorraad;

        return $this;
    }

    /**
     * @return int
     */
    public function getVrijeVoorraad(): int
    {
        return $this->vrijeVoorraad;
    }

    /**
     * @param int $vrijeVoorraad
     * @return Artikel
     */
    public function setVrijeVoorraad(?int $vrijeVoorraad): self
    {
        $this->vrijeVoorraad = $vrijeVoorraad ?? $this->vrijeVoorraad;

        return $this;
    }

    /**
     * @return null|array
     */
    public function getPrijsafspraak(): ?array
    {
        return $this->prijsafspraak;
    }

    /**
     * @param array|null $artikelomzetgroep
     * @return Artikel
     */
    public function setPrijsafspraak(?array $prijsafspraak): self
    {
        $this->prijsafspraak = $prijsafspraak;

        return $this;
    }
}
