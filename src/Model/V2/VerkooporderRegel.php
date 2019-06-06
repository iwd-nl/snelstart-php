<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Snelstart;

final class VerkooporderRegel extends BaseObject
{
    /**
     * Een container voor artikel informatie.
     *
     * @var Artikel
     */
    private $artikel;

    /**
     * De omschrijving van de verkooporderregel. Indien dit veld leeg is dan wordt de omschrijving van het artikel in dit veld gezet.
     *
     * @var string
     */
    private $omschrijving;

    /**
     * Stuksprijs van het artikel.
     *
     * @var Money
     */
    private $stuksprijs;

    /**
     * @var float
     */
    private $aantal;

    /**
     * @var float
     */
    private $kortingsPercentage;

    /**
     * @var Money
     */
    private $totaal;

    public static $editableAttributes = [
        "artikel",
        "omschrijving",
        "stuksprijs",
        "aantal",
        "kortingsPercentage",
        "totaal",
    ];

    /**
     * @return Artikel
     */
    public function getArtikel(): Artikel
    {
        return $this->artikel;
    }

    /**
     * @param Artikel $artikel
     * @return VerkooporderRegel
     */
    public function setArtikel(Artikel $artikel): self
    {
        $this->artikel = $artikel;

        if ($artikel->isHydrated()) {
            $this->setStuksprijs($artikel->getVerkoopprijs());
            $this->totaal = $artikel->getVerkoopprijs()->multiply($this->getAantal());
        }

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
     * @return VerkooporderRegel
     */
    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    /**
     * @return Money
     */
    public function getStuksprijs(): ?Money
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
     * @return float
     */
    public function getAantal(): float
    {
        return $this->aantal;
    }

    /**
     * @param float $aantal
     * @return VerkooporderRegel
     */
    public function setAantal(float $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }

    /**
     * @return float
     */
    public function getKortingsPercentage(): float
    {
        return $this->kortingsPercentage ?? 0;
    }

    /**
     * @param float $kortingsPercentage
     * @return VerkooporderRegel
     */
    public function setKortingsPercentage(float $kortingsPercentage): self
    {
        $this->kortingsPercentage = $kortingsPercentage;

        return $this;
    }

    /**
     * @return Money
     */
    public function getTotaal(): ?Money
    {
        return $this->totaal ?? new Money("0", Snelstart::getCurrency());
    }

    /**
     * @param Money $totaal
     * @return VerkooporderRegel
     */
    public function setTotaal(Money $totaal): self
    {
        $this->totaal = $totaal;

        return $this;
    }
}