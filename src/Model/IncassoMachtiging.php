<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

class IncassoMachtiging extends SnelstartObject
{
    /**
     * @var string
     */
    private $kenmerk;

    /**
     * De omschrijving van de incassomachtiging.
     * Deze is verplicht bij een eenmalige machtiging.
     *
     * @var string
     */
    private $omschrijving;

    /**
     * De datum van de incassomachtiging
     * Deze is verplicht bij een eenmalige machtiging.
     *
     * @var \DateTimeInterface
     */
    private $datum;
}