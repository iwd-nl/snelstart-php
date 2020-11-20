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
 * @method static BtwRegelSoort GEEN()
 * @method static BtwRegelSoort VERKOPENLAAG()
 * @method static BtwRegelSoort VERKOPENHOOG()
 * @method static BtwRegelSoort VERKOPENOVERIG()
 * @method static BtwRegelSoort VERKOPENVERLEGD()
 * @method static BtwRegelSoort INKOPENLAAG()
 * @method static BtwRegelSoort INKOPENHOOG()
 * @method static BtwRegelSoort INKOPENOVERIG()
 * @method static BtwRegelSoort INKOPENVERLEGD()
 */
final class BtwRegelSoort extends Enum
{
    private const GEEN              = 'Geen';
    private const VERKOPENLAAG      = 'VerkopenLaag';
    private const VERKOPENHOOG      = 'VerkopenHoog';
    private const VERKOPENOVERIG    = 'VerkopenOverig';
    private const VERKOPENVERLEGD   = 'VerkopenVerlegd';
    private const INKOPENLAAG       = 'InkopenLaag';
    private const INKOPENHOOG       = 'InkopenHoog';
    private const INKOPENOVERIG     = 'InkopenOverig';
    private const INKOPENVERLEGD    = 'InkopenVerlegd';
}