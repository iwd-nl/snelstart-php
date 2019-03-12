<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Money\Money;

use SnelstartPHP\Model\Type\ProcesStatus;
use SnelstartPHP\Model\Type\VerkooporderBtwIngaveModel;
use SnelstartPHP\Model\Verkoopboeking;

class VerkooporderRegel extends SnelstartObject
{

    /**
     * @var Artikel
     */
    private $artikel;

    /**
     * @var string
     */
    private $omschrijving;


    /**
     * @var Money
     */
    private $stuksprijs;

    /**
     * @var int
     */
    private $aantal;


    /**
     * @TODO refactor to double?
     * @var Money
     */
    private $kortingsPercentage;

    /**
     * @var Money
     */
    private $totaal;

    public static $editableAttributes = [
        'artikel',
        'omschrijving',
        'stuksprijs',
        'aantal',
        'kortingsPercentage',
        'totaal',
    ];

    public function getArtikel(): ?Artikel
    {
        return $this->artikel;
    }


    public function setArtikel(?Artikel $artikel) : VerkooporderRegel
    {
        $this->artikel = $artikel;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    /**
     * @param string|null $omschrijving
     * @return VerkooporderRegel
     */
    public function setOmschrijving(?string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    /**
     * @return Money
     */
    public function getStuksprijs(): Money
    {
        return $this->stuksprijs;
    }

    /**
     * @param Money $stuksprijs
     * @return VerkooporderRegel
     */
    public function setStuksprijs(Money $stuksprijs): self
    {
        $this->stuksprijs = $stuksprijs;

        return $this;
    }

    /**
     * @return int
     */
    public function getAantal(): int
    {
        return $this->aantal;
    }

    /**
     * @param int $aantal
     * @return VerkooporderRegel
     */
    public function setAantal(?int $aantal): self
    {
        $this->aantal = $aantal ?? $this->aantal;

        return $this;
    }

    /**
     * @return Money|null
     */
    public function getKortingsPercentage(): ?Money
    {
        return $this->kortingsPercentage;
    }

    /**
     * @param Money $kortingsPercentage
     * @return VerkooporderRegel
     */
    public function setKortingsPercentage(Money $kortingsPercentage): self
    {
        $this->kortingsPercentage = $kortingsPercentage;

        return $this;
    }

    /**
     * @return Money|null
     */
    public function getTotaal(): ?Money
    {
        return $this->totaal;
    }

    /**
     * @param Money $totaal
     * @return Verkooporder
     */
    public function setTotaal(Money $totaal): self
    {
        $this->totaal = $totaal;

        return $this;
    }

}
