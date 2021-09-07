<?php

namespace SnelstartPHP\Model\V2;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Model\Type\DagboekSoort;

/**
 * @method self setId(UuidInterface $id)
 * @method self setUri(string $uri)
 */
class Dagboek extends SnelstartObject
{
    /**
     * @var string
     */
    private $omschrijving;
    /**
     * @var DagboekSoort
     */
    private $soort;
    /**
     * @var boolean
     */
    private $nonactief;
    /**
     * @var int
     */
    private $nummer;
    /**
     * @var string[]
     */
    public static $editableAttributes = [];

    /**
     * @return string
     */
    public function getOmschrijving(): string
    {
        return $this->omschrijving;
    }

    /**
     * @param string $omschrijving
     * @return Dagboek
     */
    public function setOmschrijving(string $omschrijving): Dagboek
    {
        $this->omschrijving = $omschrijving;
        return $this;
    }

    /**
     * @return DagboekSoort
     */
    public function getSoort(): DagboekSoort
    {
        return $this->soort;
    }

    /**
     * @param DagboekSoort $soort
     * @return Dagboek
     */
    public function setSoort(DagboekSoort $soort): Dagboek
    {
        $this->soort = $soort;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNonactief(): bool
    {
        return $this->nonactief;
    }

    /**
     * @param bool $nonactief
     * @return Dagboek
     */
    public function setNonactief(bool $nonactief): Dagboek
    {
        $this->nonactief = $nonactief;
        return $this;
    }

    /**
     * @return int
     */
    public function getNummer(): int
    {
        return $this->nummer;
    }

    /**
     * @param int $nummer
     * @return Dagboek
     */
    public function setNummer(int $nummer): Dagboek
    {
        $this->nummer = $nummer;
        return $this;
    }


}
