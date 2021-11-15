<?php

namespace SnelstartPHP\Model\Type;

use MyCLabs\Enum\Enum;
/**
 * @psalm-immutable
 *
 * @method static BtwBoekingsregelType TEVORDERENBTWTYPE()
 * @method static BtwBoekingsregelType AFTEDRAGENBTWTYPE()
 */
final class BtwBoekingsregelType extends Enum
{
    private const TEVORDERENBTWTYPE   =   'TeVorderenBtwType';
    private const AFTEDRAGENBTWTYPE   =   'AfTeDragenBtwType';
}
