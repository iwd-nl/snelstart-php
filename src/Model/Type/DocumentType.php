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
 * @method static DocumentType INKOOPBOEKINGEN()
 * @method static DocumentType VERKOOPBOEKINGEN()
 * @method static DocumentType RELATIES()
 */
final class DocumentType extends Enum
{
    private const INKOOPBOEKINGEN = 'Inkoopboekingen';
    private const VERKOOPBOEKINGEN = 'Verkoopboekingen';
    private const RELATIES = 'Relaties';
}