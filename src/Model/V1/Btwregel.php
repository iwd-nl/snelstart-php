<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Model\V1;

use Money\Money;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\Type\BtwRegelSoort;

/**
 * @deprecated
 */
final class Btwregel extends BaseObject
{
    /**
     * @var BtwRegelSoort
     */
    private $btwSoort;

    /**
     * @var Money
     */
    private $btwBedrag;

    public static $editableAttributes = [
        "btwSoort",
        "btwBedrag",
    ];

    public function __construct(BtwRegelSoort $btwRegelSoort, Money $btwBedrag)
    {
        $this->setBtwSoort($btwRegelSoort)->setBtwBedrag($btwBedrag);
    }

    /**
     * @return BtwRegelSoort
     */
    public function getBtwSoort(): BtwRegelSoort
    {
        return $this->btwSoort;
    }

    /**
     * @param BtwRegelSoort $btwSoort
     * @return Btwregel
     */
    public function setBtwSoort(BtwRegelSoort $btwSoort): self
    {
        $this->btwSoort = $btwSoort;

        return $this;
    }

    /**
     * @return Money
     */
    public function getBtwBedrag(): Money
    {
        return $this->btwBedrag;
    }

    /**
     * @param Money $btwBedrag
     * @return Btwregel
     */
    public function setBtwBedrag(Money $btwBedrag): self
    {
        $this->btwBedrag = $btwBedrag;

        return $this;
    }
}