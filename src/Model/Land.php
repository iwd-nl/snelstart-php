<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

class Land extends SnelstartObject
{
    /**
     * De naam van het land.
     *
     * @var string
     */
    private $naam;

    /**
     * De ISO code van het land.
     *
     * @var string
     */
    private $landcodeISO;

    /**
     * De code van het land.
     *
     * @var string
     */
    private $landcode;

    /**
     * @return string
     */
    public function getNaam(): string
    {
        return $this->naam;
    }

    /**
     * @param string $naam
     * @return Land
     */
    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * @return string
     */
    public function getLandcodeISO(): string
    {
        return $this->landcodeISO;
    }

    /**
     * @param string $landcodeISO
     * @return Land
     */
    public function setLandcodeISO(string $landcodeISO): self
    {
        $this->landcodeISO = $landcodeISO;

        return $this;
    }

    /**
     * @return string
     */
    public function getLandcode(): string
    {
        return $this->landcode;
    }

    /**
     * @param string $landcode
     * @return Land
     */
    public function setLandcode(string $landcode): self
    {
        $this->landcode = $landcode;

        return $this;
    }
}