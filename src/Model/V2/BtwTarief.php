<?php

declare(strict_types=1);

namespace SnelstartPHP\Model\V2;

use DateTimeImmutable;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\Type\BtwSoort;

final class BtwTarief extends BaseObject
{
    /**
     * @var BtwSoort
     */
    private $btwSoort;

    /**
     * @var float
     */
    private $btwPercentage;

    /**
     * @var DateTimeImmutable
     */
    private $datumVanaf;

    /**
     * @var DateTimeImmutable
     */
    private $datumTotEnMet;

    /**
     * @var string[]
     */
    public static $editableAttributes = [];

    /**
     * @return BtwSoort
     */
    public function getBtwSoort(): BtwSoort
    {
        return $this->btwSoort;
    }

    /**
     * @param BtwSoort $btwSoort
     * @return $this
     */
    public function setBtwSoort(BtwSoort $btwSoort): self
    {
        $this->btwSoort = $btwSoort;

        return $this;
    }

    /**
     * @return float
     */
    public function getBtwPercentage(): float
    {
        return $this->btwPercentage;
    }

    /**
     * @param float $btwPercentage
     * @return $this
     */
    public function setBtwPercentage(float $btwPercentage): self
    {
        $this->btwPercentage = $btwPercentage;

        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDatumVanaf(): DateTimeImmutable
    {
        return $this->datumVanaf;
    }

    /**
     * @param DateTimeImmutable $datumVanaf
     * @return $this
     */
    public function setDatumVanaf(DateTimeImmutable $datumVanaf): self
    {
        $this->datumVanaf = $datumVanaf;

        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDatumTotEnMet(): ?DateTimeImmutable
    {
        return $this->datumTotEnMet;
    }

    /**
     * @param DateTimeImmutable $datumTotEnMet
     * @return $this
     */
    public function setDatumTotEnMet(DateTimeImmutable $datumTotEnMet): self
    {
        $this->datumTotEnMet = $datumTotEnMet;

        return $this;
    }
}
