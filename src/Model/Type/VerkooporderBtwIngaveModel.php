<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

/**
 * @method static ProcesStatus INCLUSIEF()
 * @method static ProcesStatus EXCLUSIEF()
 */
class VerkooporderBtwIngaveModel extends Enum
{
    private const INCLUSIEF = "Inclusief";
    private const EXCLUSIEF = "Exclusief";
}