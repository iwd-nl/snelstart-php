<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Model\V1;

use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Model\Type as Types;

/**
 * @deprecated
 */
final class Dagboek extends SnelstartObject
{
    /**
     * Het nummer van het grootboek.
     *
     * @var int
     */
    private $nummer;

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
     * @var Types\Rekeningcode
     */
    private $rekeningCode;

    /**
     * Een vlag dat aangeeft of het grootboek niet meer actief is binnen de administratie.
     * Indien 'true', dan kan het grootboek als "verwijderd" worden beschouwd.
     *
     * @var boolean
     */
    private $nonactief;

    /**
     * De grootboekfunctie van het grootboek.
     *
     * @var Types\Grootboekfunctie
     */
    private $grootboekfunctie;

    /**
     * RgsCodes
     *
     * @var RgsCode[]
     */
    private $rgsCode;
}