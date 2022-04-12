<?php

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\Type\BtwSoort;

final class KasBoekingsregel extends BaseObject
{
    /**
     * De omschrijving van de boekingsregel.
     *
     * @var string|null
     */
    private $omschrijving;

    /**
     * De grootboekrekening waarop de mutatie (omzet) wordt geboekt.
     *
     * @var Grootboek
     */
    private $grootboek;

    /**
     * De kostenplaats waarop deze mutatie (omzet) is geregistreerd.
     *
     * @var Kostenplaats|null
     */
    private $kostenplaats;

    /**
     * Het omzetbedrag van de regel, exclusief btw.
     *
     * @var Money
     */
    private $debet;
    /**
     * Het omzetbedrag van de regel, exclusief btw.
     *
     * @var Money
     */
    private $credit;

    /**
     * Mag leeg worden gelaten of met de juiste waarde worden ingevuld behalve als de grootboek een
     * grootboekfunctie 30 (Inkopen kosten alle btwtarieven) of 34 (inkopen vraagposten) heeft.
     *
     * @var BtwSoort
     */
    private $btwSoort;

    public static $editableAttributes = [
        "omschrijving",
        "grootboek",
        "kostenplaats",
        "debet",
        "credit",
        "btwSoort",
    ];

    /**
     * @return string
     */
    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    /**
     * @param string $omschrijving
     *
     * @return self
     */
    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    /**
     * @return Grootboek
     */
    public function getGrootboek(): Grootboek
    {
        return $this->grootboek;
    }

    /**
     * @param Grootboek $grootboek
     *
     * @return self
     */
    public function setGrootboek(Grootboek $grootboek): self
    {
        $this->grootboek = $grootboek;

        return $this;
    }

    /**
     * @return Kostenplaats
     */
    public function getKostenplaats(): ?Kostenplaats
    {
        return $this->kostenplaats;
    }

    /**
     * @param Kostenplaats $kostenplaats
     *
     * @return self
     */
    public function setKostenplaats(Kostenplaats $kostenplaats): self
    {
        $this->kostenplaats = $kostenplaats;

        return $this;
    }

    /**
     * @return BtwSoort
     */
    public function getBtwSoort(): ?BtwSoort
    {
        return $this->btwSoort;
    }

    /**
     * @param BtwSoort $btwSoort
     *
     * @return self
     */
    public function setBtwSoort(BtwSoort $btwSoort): self
    {
        $this->btwSoort = $btwSoort;

        return $this;
    }

    /**
     * @return Money
     */
    public function getDebet(): Money
    {
        return $this->debet;
    }

    /**
     * @param Money $debet
     * @return KasBoekingsregel
     */
    public function setDebet(Money $debet): KasBoekingsregel
    {
        $this->debet = $debet;
        return $this;
    }

    /**
     * @return Money
     */
    public function getCredit(): Money
    {
        return $this->credit;
    }

    /**
     * @param Money $credit
     * @return KasBoekingsregel
     */
    public function setCredit(Money $credit): KasBoekingsregel
    {
        $this->credit = $credit;
        return $this;
    }

}
