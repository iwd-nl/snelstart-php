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
 * @method static Relatiesoort LEVERANCIER()
 * @method static Relatiesoort KLANT()
 * @method static Relatiesoort EIGEN()
 */
final class Relatiesoort extends Enum
{
    private const LEVERANCIER       = 'Leverancier';
    private const KLANT             = 'Klant';
    private const EIGEN             = 'Eigen';
}