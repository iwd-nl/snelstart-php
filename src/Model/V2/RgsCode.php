<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Model\V2;

use SnelstartPHP\Model\BaseObject;

final class RgsCode extends BaseObject
{
    /**
     * Rgs versie
     *
     * @var string
     */
    private $versie;

    /**
     * Rgs code
     *
     * @var string
     */
    private $rgsCode;

    public function __construct(string $versie, string $rgsCode)
    {
        $this->versie = $versie;
        $this->rgsCode = $rgsCode;
    }

    public function getVersie(): string
    {
        return $this->versie;
    }

    public function setVersie(string $versie): self
    {
        $this->versie = $versie;

        return $this;
    }

    public function getRgsCode(): string
    {
        return $this->rgsCode;
    }

    public function setRgsCode(string $rgsCode): self
    {
        $this->rgsCode = $rgsCode;

        return $this;
    }
}