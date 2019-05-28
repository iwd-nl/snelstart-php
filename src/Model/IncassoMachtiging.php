<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

final class IncassoMachtiging extends SnelstartObject
{
    /**
     * @var string
     */
    private $kenmerk;

    /**
     * De omschrijving van de incassomachtiging.
     * Deze is verplicht bij een eenmalige machtiging.
     *
     * @var string
     */
    private $omschrijving;

    /**
     * De datum van de incassomachtiging
     * Deze is verplicht bij een eenmalige machtiging.
     *
     * @var \DateTimeInterface
     */
    private $datum;

    /**
     * @return string
     */
    public function getKenmerk(): string
    {
        return $this->kenmerk;
    }

    /**
     * @param string $kenmerk
     * @return IncassoMachtiging
     */
    public function setKenmerk(string $kenmerk): IncassoMachtiging
    {
        $this->kenmerk = $kenmerk;

        return $this;
    }

    /**
     * @return string
     */
    public function getOmschrijving(): string
    {
        return $this->omschrijving;
    }

    /**
     * @param string $omschrijving
     * @return IncassoMachtiging
     */
    public function setOmschrijving(string $omschrijving): IncassoMachtiging
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDatum(): \DateTimeInterface
    {
        return $this->datum;
    }

    /**
     * @param \DateTimeInterface $datum
     * @return IncassoMachtiging
     */
    public function setDatum(\DateTimeInterface $datum): IncassoMachtiging
    {
        $this->datum = $datum;

        return $this;
    }

    public function isDoorlopendeIncassoMachtiging(): bool
    {
        return $this->id !== null;
    }
}