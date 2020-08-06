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
     * @var Artikel|null
     */
    private $artikel;

    /**
     * De omschrijving van de verkooporderregel. Indien dit veld leeg is dan wordt de omschrijving van het artikel in dit veld gezet.
     *
     * @var string|null
     */
    private $omschrijving;

    /**
     * Stuksprijs van het artikel.
     *
     * @var Money|null
     */
    private $stuksprijs;

    /**
     * @var float
     */
    private $aantal = 0;

    /**
     * @var float
     */
    private $kortingsPercentage = 0;

    /**
     * @var Money|null
     */
    private $totaal;

    /**
     * @var string[]
     */
    public static $editableAttributes = [
        "artikel",
        "omschrijving",
        "stuksprijs",
        "aantal",
        "kortingsPercentage",
        "totaal",
    ];

    public function getArtikel(): ?Artikel
    {
        return $this->artikel;
    }

    public function setArtikel(Artikel $artikel): self
    {
        $this->artikel = $artikel;

        if ($artikel->isHydrated()) {
            $this->setStuksprijs($artikel->getVerkoopprijs());
        }

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

    public function getStuksprijs(): ?Money
    {
        return $this->stuksprijs;
    }

    public function setStuksprijs(Money $stuksprijs): self
    {
        $this->stuksprijs = $stuksprijs;

        return $this;
    }

    public function getAantal(): float
    {
        return $this->aantal;
    }

    public function setAantal(float $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }

    public function getKortingsPercentage(): float
    {
        return $this->kortingsPercentage;
    }

    public function setKortingsPercentage(float $kortingsPercentage): self
    {
        $this->kortingsPercentage = $kortingsPercentage;

        return $this;
    }

    public function getTotaal(): ?Money
    {
        return $this->totaal ?? new Money("0", Snelstart::getCurrency());
    }

    public function setTotaal(Money $totaal): self
    {
        $this->totaal = $totaal;

        return $this;
    }

    public function calculateAndSetTotaal(): self
    {
        if ($this->getStuksprijs() !== null) {
            $this->totaal = $this->getStuksprijs()->multiply($this->getAantal());
        }

        return $this;
    }
}