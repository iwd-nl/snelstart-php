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
 * @method static VerkooporderStatus INBEHANDELING()
 * @method static VerkooporderStatus UITGEVOERD()
 * @method static VerkooporderStatus SERVICE()
 */
class VerkooporderStatus extends Enum
{
    private const INBEHANDELING = 'InBehandeling';

    private const UITGEVOERD = 'Uitgevoerd';

    private const SERVICE = 'Service';
}