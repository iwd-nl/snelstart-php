<?php

namespace SnelstartPHP\Model\V2;

use Money\Money;

class Kasboeking extends Boeking
{
    /**
     *
     * @var \DateTimeInterface|null
     */
    protected $datum;
    /**
     * Container voor gegevens van een boeking met een grootboek
     * @var KasBoekingsregel[]
     * @see KasBoekingsregel
     */
    protected $grootboekBoekingsRegels;
    /**
     * Container met gegevens voor een boekingsreegel met een inkoopboeking
     * @var KasBoekingsregel[]
     * @see KasBoekingsregel
     */
    protected $inkoopboekingBoekingsRegels;
    /**
     * Container met gegevens voor een boekingsreegel met een inkoopboeking
     * @var KasBoekingsregel[]
     * @see KasBoekingsregel
     */
    protected $verkoopboekingBoekingsRegels;
    /**
     * Container met gegevens voor een boekingsreegel met een inkoopboeking
     * @var BtwBoekingsregel[]
     * @see BtwBoekingsregel
     */
    protected $btwBoekingsregels;
    /**
     * @var  Money
     */
    protected $bedragUitgegeven;
    /**
     * @var  Money
     */
    protected $bedragOntvangen;
    /**
     * @var  Dagboek
     */
    protected $dagboek;

    public static $editableAttributes = [
        "id",
        "dagboek",
        "boekstuk",
        "gewijzigdDoorAccountant",
        "markering",
        "omschrijving",
        "datum",
        "grootboekBoekingsRegels",
        "inkoopboekingBoekingsRegels",
        "verkoopboekingBoekingsRegels",
        "btwBoekingsregels",
        "bedragOntvangen",
        "bedragUitgegeven",
    ];
    /**
     * @return \DateTimeInterface|null
     */
    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    /**
     * @param \DateTimeInterface|null $datum
     * @return Kasboeking
     */
    public function setDatum(?\DateTimeInterface $datum)
    {
        $this->datum = $datum;
        return $this;
    }

    /**
     * @return KasBoekingsregel[]
     */
    public function getGrootboekBoekingsRegels(): ?array
    {
        return $this->grootboekBoekingsRegels;
    }

    /**
     * @param KasBoekingsregel[] $grootboekBoekingsRegels
     * @return Kasboeking
     */
    public function setGrootboekBoekingsRegels(KasBoekingsregel ... $grootboekBoekingsRegels)
    {
        $this->grootboekBoekingsRegels = $grootboekBoekingsRegels;
        return $this;
    }

    /**
     * @return KasBoekingsregel[]
     */
    public function getInkoopboekingBoekingsRegels():  ?array
    {
        return $this->inkoopboekingBoekingsRegels;
    }

    /**
     * @param KasBoekingsregel[] $inkoopboekingBoekingsRegels
     * @return Kasboeking
     */
    public function setInkoopboekingBoekingsRegels(KasBoekingsregel ... $inkoopboekingBoekingsRegels)
    {
        $this->inkoopboekingBoekingsRegels = $inkoopboekingBoekingsRegels;
        return $this;
    }

    /**
     * @return KasBoekingsregel[]
     */
    public function getVerkoopboekingBoekingsRegels():  ?array
    {
        return $this->verkoopboekingBoekingsRegels;
    }

    /**
     * @param KasBoekingsregel[] $verkoopboekingBoekingsRegels
     * @return Kasboeking
     */
    public function setVerkoopboekingBoekingsRegels(KasBoekingsregel ...$verkoopboekingBoekingsRegels)
    {
        $this->verkoopboekingBoekingsRegels = $verkoopboekingBoekingsRegels;
        return $this;
    }

    /**
     * @return BtwBoekingsregel[]
     */
    public function getBtwBoekingsregels():  ?array
    {
        return $this->btwBoekingsregels;
    }

    /**
     * @param BtwBoekingsregel[] $btwBoekingsregels
     * @return Kasboeking
     */
    public function setBtwBoekingsregels(BtwBoekingsregel ...$btwBoekingsregels)
    {
        $this->btwBoekingsregels = $btwBoekingsregels;
        return $this;
    }

    /**
     * @return Money
     */
    public function getBedragUitgegeven(): ?Money
    {
        return $this->bedragUitgegeven;
    }

    /**
     * @param Money $bedragUitgegeven
     * @return Kasboeking
     */
    public function setBedragUitgegeven(Money $bedragUitgegeven)
    {
        $this->bedragUitgegeven = $bedragUitgegeven;
        return $this;
    }

    /**
     * @return Money
     */
    public function getBedragOntvangen(): ?Money
    {
        return $this->bedragOntvangen;
    }

    /**
     * @param Money $bedragOntvangen
     * @return Kasboeking
     */
    public function setBedragOntvangen(Money $bedragOntvangen)
    {
        $this->bedragOntvangen = $bedragOntvangen;
        return $this;
    }

    /**
     * @return Dagboek
     */
    public function getDagboek(): ?Dagboek
    {
        return $this->dagboek;
    }

    /**
     * @param Dagboek $dagboek
     * @return Kasboeking
     */
    public function setDagboek(Dagboek $dagboek)
    {
        $this->dagboek = $dagboek;
        return $this;
    }

}
