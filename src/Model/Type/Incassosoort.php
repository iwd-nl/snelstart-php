<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

class Incassosoort extends Enum
{
    private const GEEN  = 'Geen';
    private const CORE  = 'Core';
    private const B2B   = 'B2B';
}