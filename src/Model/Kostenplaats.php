<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

class Kostenplaats extends SnelstartObject
{
    /**
     * De omschrijving van de kostenplaats.
     *
     * @var string
     */
    private $omschrijving;

    /**
     * Een vlag dat aangeeft of een kostenplaats niet meer actief is binnen de administratie.\r\nIndien <see langword=\"true\" />, dan kan er niet geboekt worden op de kostenplaats.
     *
     * @var bool
     */
    private $nonactief;

    /**
     * Het nummer van de kostenplaats.
     *
     * @var int
     */
    private $nummer;
}