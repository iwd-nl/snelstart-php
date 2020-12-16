<?php
declare(strict_types=1);

namespace SnelstartPHP\Model;

final class NaamWaarde extends BaseObject
{
    /**
     * @var string
     */
    private $naam;

    /**
     * @var mixed
     */
    private $waarde;

    public static $editableAttributes = [
        "naam",
        "waarde",
    ];

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): NaamWaarde
    {
        $this->naam = $naam;

        return $this;
    }

    public function getWaarde(): string
    {
        return $this->waarde;
    }

    public function setWaarde($waarde): NaamWaarde
    {
        $this->waarde = $waarde;

        return $this;
    }
}