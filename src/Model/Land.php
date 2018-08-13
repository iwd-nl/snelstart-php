<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Ramsey\Uuid\UuidInterface;

class Land extends SnelstartObject
{
    /**
     * De publieke sleutel (public identifier, als uuid) dat uniek een object identificeert.
     *
     * @var UuidInterface
     */
    private $id;

    /**
     * Geeft de realtieve uri terug van het object waartoe de identifier behoort.
     *
     * @var string
     */
    private $uri;

    /**
     * De naam van het land.
     *
     * @var string
     */
    private $naam;

    /**
     * De ISO code van het land.
     *
     * @var string
     */
    private $landcodeISO;

    /**
     * De code van het land.
     *
     * @var string
     */
    private $landcode;
}