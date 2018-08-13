<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Money\Money;

class Inkoopboeking extends SnelstartObject
{
    /**
     * Het tijdstip waarop het grootboek is aangemaakt of voor het laatst is gewijzigd
     *
     * @var \DateTimeInterface|null
     */
    private $modifiedOn;

    /**
     * Het boekstuknummer van de inkoopboeking.
     *
     * @var string
     */
    private $boekstuk;

    /**
     * Geeft aan of deze inkoopboeking is aangepast door de accountant.
     *
     * @var bool
     */
    private $gewijzigdDoorAccountant;

    /**
     * Deze inkoopboeking verdient speciale aandacht, in SnelStart wordt dit visueel benadrukt.
     *
     * @var bool
     */
    private $markering;

    /**
     * De datum van de factuur, dit is ook de datum waarop de inkoopboeking wordt geboekt.
     *
     * @var \DateTimeInterface|null
     */
    private $factuurdatum;

    /**
     * De factuurnummer van de inkoopboeking.
     *
     * @var string
     */
    private $factuurnummer;

    /**
     * De leverancier/crediteur van wie de factuur afkomstig is.
     *
     * @var Relatie
     */
    private $leverancier;

    /**
     * De omschrijving van de inkoopboeking.
     *
     * @var string
     */
    private $omschrijving;

    /**
     * @var Money
     */
    private $factuurbedrag;

    /**
     * De omzetregels van de inkoopboeking. De btw-bedragen staan hier niet in,
     * deze staan in de Btw-collectie.
     *
     * @see Inkoopboekingsregel
     * @var array[Inkoopboekingsregel]
     */
    private $boekingsregels;

    /**
     * De af te dragen btw van de inkoopboeking per btw-tarief
     *
     * @see InkoopBtwregel
     * @var array[InkoopBtwregel]
     */
    private $btw;

    /**
     * @var string
     */
    private $bijlagenUri;
}