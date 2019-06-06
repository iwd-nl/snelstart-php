<?php
/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

/**
 * @method static ProcesStatus ORDER()
 * @method static ProcesStatus OFFERTE()
 * @method static ProcesStatus BEVESTIGING()
 * @method static ProcesStatus WERKBON()
 * @method static ProcesStatus PAKBON()
 * @method static ProcesStatus AFHAALBON()
 * @method static ProcesStatus CONTANTBON()
 * @method static ProcesStatus FACTUUR()
 */
final class ProcesStatus extends Enum
{
    private const ORDER = 'Order';
    private const OFFERTE = 'Offerte';
    private const BEVESTIGING = 'Bevestiging';
    private const WERKBON = 'Werkbon';
    private const PAKBON = 'Pakbon';
    private const AFHAALBON = 'Afhaalbon';
    private const CONTANTBON = 'Contantbon';
    private const FACTUUR = 'Factuur';
}