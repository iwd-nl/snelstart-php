<?php

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;
/**
 * @psalm-immutable
 *
 * @method static DagboekSoort GEEN()
 * @method static DagboekSoort KAS()
 * @method static DagboekSoort BANK()
 * @method static DagboekSoort VERKOOP()
 * @method static DagboekSoort INKOOP()
 * @method static DagboekSoort BALANS()
 * @method static DagboekSoort MEMORIAAL()
 */
class DagboekSoort extends Enum
{
    private const GEEN    = 'Geen';
    private const KAS      = 'Kas';
    private const BANK      = 'Bank';
    private const VERKOOP      = 'Verkoop';
    private const INKOOP    = 'Inkoop';
    private const MEMORIAAL    = 'Memoriaal';
    private const BALANS    = 'Balans';
}
