<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Model\V1;

use Money\Money;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\Kostenplaats;
use SnelstartPHP\Model\Type\BtwSoort;

/**
 * @deprecated
 */
final class Boekingsregel extends BaseObject
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
    private $bedrag;

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
        "bedrag",
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
     * @return Boekingsregel
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
     * @return Boekingsregel
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
     * @return Boekingsregel
     */
    public function setKostenplaats(Kostenplaats $kostenplaats): self
    {
        $this->kostenplaats = $kostenplaats;

        return $this;
    }

    /**
     * @return Money
     */
    public function getBedrag(): Money
    {
        return $this->bedrag;
    }

    /**
     * @param Money $bedrag
     * @return Boekingsregel
     */
    public function setBedrag(Money $bedrag): self
    {
        $this->bedrag = $bedrag;

        return $this;
    }

    /**
     * @return BtwSoort
     */
    public function getBtwSoort(): BtwSoort
    {
        return $this->btwSoort;
    }

    /**
     * @param BtwSoort $btwSoort
     * @return Boekingsregel
     */
    public function setBtwSoort(BtwSoort $btwSoort): self
    {
        $this->btwSoort = $btwSoort;

        return $this;
    }
}