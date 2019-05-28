<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

/**
 * @method static BtwRegelSoort GEEN()
 * @method static BtwRegelSoort CORE()
 * @method static BtwRegelSoort B2B()
 */
final class Incassosoort extends Enum
{
    private const GEEN  = 'Geen';
    private const CORE  = 'Core';
    private const B2B   = 'B2B';
}