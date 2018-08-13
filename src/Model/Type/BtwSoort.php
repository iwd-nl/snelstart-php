<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

class BtwSoort extends Enum
{
    private const GEEN      = 'Geen';
    private const Laag      = 'Laag';
    private const HOOG      = 'Hoog';
    private const OVERIG    = 'Overig';
}