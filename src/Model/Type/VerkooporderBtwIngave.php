<?php
/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

/**
 * @psalm-immutable
 *
 * @method static VerkooporderBtwIngave INCLUSIEF()
 * @method static VerkooporderBtwIngave EXCLUSIEF()
 */
final class VerkooporderBtwIngave extends Enum
{
    private const INCLUSIEF = 'Inclusief';
    private const EXCLUSIEF = 'Exclusief';
}