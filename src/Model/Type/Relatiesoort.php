<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

class Relatiesoort extends Enum
{
    private const LEVERANCIER       = 'Leverancier';
    private const KLANT             = 'Klant';
}