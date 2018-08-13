<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Ramsey\Uuid\UuidInterface;

abstract class RelatieAdres
{
    /**
     * De volledige naam van de contactpersoon op dit adres.
     *
     * @var string|null
     */
    private $contactpersoon;

    /**
     * De straatnaam (inclusief huisnummer).
     *
     * @var string|null
     */
    private $straat;

    /**
     * De postcode van het adres.
     *
     * @var string|null
     */
    private $postcode;

    /**
     * De plaatsnaam van het adres.
     *
     * @var string|null
     */
    private $plaats;

    /**
     * De Id van het land waartoe dit adres behoord.
     * Indien niets is opgegeven is dit standaard "Nederland".
     *
     * @var UuidInterface|null
     */
    private $land;
}