<?php

namespace SnelstartPHP\Model\V2;

use Money\Money;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\Type\BtwBoekingsregelType;
use SnelstartPHP\Model\Type\BtwSoort;

class BtwBoekingsregel extends BaseObject
{
    /**
     * @var BtwSoort
     */
    private $tarief;

    /**
     * @var BtwBoekingsregelType
     */
    private $type;
    /**
     * Het omzetbedrag van de regel, exclusief btw.
     *
     * @var Money
     */
    private $debet;
    /**
     * Het omzetbedrag van de regel, exclusief btw.
     *
     * @var Money
     */
    private $credit;

    /**
     * @return BtwSoort
     */
    public function getTarief(): BtwSoort
    {
        return $this->tarief;
    }

    /**
     * @param BtwSoort $tarief
     * @return BtwBoekingsregel
     */
    public function setTarief(BtwSoort $tarief): BtwBoekingsregel
    {
        $this->tarief = $tarief;
        return $this;
    }

    /**
     * @return BtwBoekingsregelType
     */
    public function getType(): BtwBoekingsregelType
    {
        return $this->type;
    }

    /**
     * @param BtwBoekingsregelType $type
     * @return BtwBoekingsregel
     */
    public function setType(BtwBoekingsregelType $type): BtwBoekingsregel
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Money
     */
    public function getDebet(): Money
    {
        return $this->debet;
    }

    /**
     * @param Money $debet
     * @return BtwBoekingsregel
     */
    public function setDebet(Money $debet): BtwBoekingsregel
    {
        $this->debet = $debet;
        return $this;
    }

    /**
     * @return Money
     */
    public function getCredit(): Money
    {
        return $this->credit;
    }

    /**
     * @param Money $credit
     * @return BtwBoekingsregel
     */
    public function setCredit(Money $credit): BtwBoekingsregel
    {
        $this->credit = $credit;
        return $this;
    }

}
