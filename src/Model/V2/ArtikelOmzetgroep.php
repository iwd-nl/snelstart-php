<?php
/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\SnelstartObject;

final class ArtikelOmzetgroep extends SnelstartObject
{
    /**
     * Omzetgroep nummer
     *
     * @var int
     */
    private $nummer;

    /**
     * Omschijving van de omzet groep
     *
     * @var string
     */
    private $omschrijving;

    /**
     * @var string[]
     */
    public static $editableAttributes = [
        "nummer",
        "omschrijving",
    ];

    public function getNummer(): int
    {
        return $this->nummer;
    }

    public function setNummer(int $nummer): self
    {
        $this->nummer = $nummer;

        return $this;
    }

    public function getOmschrijving(): string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        if (mb_strlen($omschrijving) > 50) {
            throw PreValidationException::textLengthException(mb_strlen($omschrijving), 50);
        }

        $this->omschrijving = $omschrijving;

        return $this;
    }
}