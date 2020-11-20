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
 * @method static Rekeningcode BALANS()
 * @method static Rekeningcode WINSTENVERLIES()
 */
final class Rekeningcode extends Enum
{
    private const BALANS            = 'Balans';
    private const WINSTENVERLIES    = 'WinstEnVerlies';
}