<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;

class BtwRegelSoort extends Enum
{
    private const GEEN              = 'Geen';
    private const VERKOPENLAAG      = 'VerkopenLaag';
    private const VERKOPENHOOG      = 'VerkopenHoog';
    private const VERKOPENOVERIG    = 'VerkopenOverig';
    private const INKOPENLAAG       = 'InkopenLaag';
    private const INKOPENHOOG       = 'InkopenHoog';
    private const INKOPENOVERIG     = 'InkopenOverig';
    private const INKOPENVERLEGD    = 'InkopenVerlegd';
}