<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Money\Money;
use SnelstartPHP\Model\Type\BtwSoort;

class Inkoopboekingsregel
{
    /**
     * De omschrijving van de boekingsregel.
     *
     * @var string
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
     * @var Kostenplaats
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
}