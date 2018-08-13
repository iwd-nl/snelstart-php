<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

class Rekeningcode extends Enum
{
    private const BALANS            = 'Balans';
    private const WINSTENVERLIES    = 'WinstEnVerlies';
}