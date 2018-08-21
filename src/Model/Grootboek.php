<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use SnelstartPHP\Model\Type\Grootboekfunctie;
use SnelstartPHP\Model\Type\Rekeningcode;

class Grootboek extends SnelstartObject
{
    /**
     * Het tijdstip waarop het grootboek is aangemaakt of voor het laatst is gewijzigd
     *
     * @var \DateTimeInterface|null
     */
    private $modifiedOn;

    /**
     * De omschrijving van het grootboek.
     *
     * @var string
     */
    private $omschrijving;

    /**
     * Kostenplaats wel of niet verplicht bij het boeken.
     *
     * @var bool
     */
    private $kostenplaatsVerplicht;

    /**
     * Rekening code van het grootboek.
     *
     * @var Rekeningcode
     */
    private $rekeningCode;

    /**
     * Een vlag dat aangeeft of het grootboek niet meer actief is binnen de administratie.
     * Indien true, dan kan het grootboek als "verwijderd" worden beschouwd.
     *
     * @var bool
     */
    private $nonactief;

    /**
     * Het nummer van het grootboek.
     *
     * @var int
     */
    private $nummer;

    /**
     * De grootboekfunctie van het grootboek.
     *
     * @var Grootboekfunctie
     */
    private $grootboekfunctie;

    /**
     * RgsCodes
     *
     * @var array[RgsCode]
     * @see RgsCode
     */
    private $rgsCode = [];
}