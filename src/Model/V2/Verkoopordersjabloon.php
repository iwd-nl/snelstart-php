<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use SnelstartPHP\Model\SnelstartObject;

final class Verkoopordersjabloon extends SnelstartObject
{
    /**
     * De omschrijving van het sjabloon.
     *
     * @var string
     */
    private $omschrijving;

    /**
     * Een vlag dat aangeeft of een sjabloon niet meer actief is binnen de administratie.\r\nIndien <see langword=\"true\" />, dan kan het sjabloon als \"verwijderd\" worden beschouwd.
     *
     * @var bool
     */
    private $nonactief;
}