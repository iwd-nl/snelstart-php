<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use SnelstartPHP\Model\SnelstartObject;

final class SubArtikel extends SnelstartObject
{
    /**
     * @var string
     */
    private $artikelcode;

    /**
     * @var float
     */
    private $aantal;

    public static $editableAttributes = [
        "artikelcode",
        "aantal",
    ];

    public function getArtikelcode(): string
    {
        return $this->artikelcode;
    }

    public function setArtikelcode(string $artikelcode): SubArtikel
    {
        $this->artikelcode = $artikelcode;

        return $this;
    }

    public function getAantal(): float
    {
        return $this->aantal;
    }

    public function setAantal(float $aantal): SubArtikel
    {
        $this->aantal = $aantal;

        return $this;
    }
}