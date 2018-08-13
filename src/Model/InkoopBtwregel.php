<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Money\Money;
use SnelstartPHP\Model\Type\BtwRegelSoort;

class InkoopBtwregel
{
    /**
     * @var BtwRegelSoort
     */
    private $btwSoort;

    /**
     * @var Money
     */
    private $btwBedrag;
}