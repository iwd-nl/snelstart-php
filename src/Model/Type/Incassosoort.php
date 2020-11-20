<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

/**
 * @psalm-immutable
 *
 * @method static Incassosoort GEEN()
 * @method static Incassosoort CORE()
 * @method static Incassosoort B2B()
 */
final class Incassosoort extends Enum
{
    private const GEEN  = 'Geen';
    private const CORE  = 'Core';
    private const B2B   = 'B2B';
}