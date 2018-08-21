<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Ramsey\Uuid\UuidInterface;

abstract class RelatieAdres
{
    /**
     * De volledige naam van de contactpersoon op dit adres.
     *
     * @var string|null
     */
    protected $contactpersoon;

    /**
     * De straatnaam (inclusief huisnummer).
     *
     * @var string|null
     */
    protected $straat;

    /**
     * De postcode van het adres.
     *
     * @var string|null
     */
    protected $postcode;

    /**
     * De plaatsnaam van het adres.
     *
     * @var string|null
     */
    protected $plaats;

    /**
     * De Id van het land waartoe dit adres behoord.
     * Indien niets is opgegeven is dit standaard "Nederland".
     *
     * @var UuidInterface|null
     */
    protected $land;

    /**
     * @return null|string
     */
    public function getContactpersoon(): ?string
    {
        return $this->contactpersoon;
    }

    /**
     * @param null|string $contactpersoon
     * @return RelatieAdres
     */
    public function setContactpersoon(?string $contactpersoon): RelatieAdres
    {
        $this->contactpersoon = $contactpersoon;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getStraat(): ?string
    {
        return $this->straat;
    }

    /**
     * @param null|string $straat
     * @return RelatieAdres
     */
    public function setStraat(?string $straat): RelatieAdres
    {
        $this->straat = $straat;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * @param null|string $postcode
     * @return RelatieAdres
     */
    public function setPostcode(?string $postcode): RelatieAdres
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPlaats(): ?string
    {
        return $this->plaats;
    }

    /**
     * @param null|string $plaats
     * @return RelatieAdres
     */
    public function setPlaats(?string $plaats): RelatieAdres
    {
        $this->plaats = $plaats;

        return $this;
    }

    /**
     * @return null|UuidInterface
     */
    public function getLand(): ?UuidInterface
    {
        return $this->land;
    }

    /**
     * @param null|UuidInterface $land
     * @return RelatieAdres
     */
    public function setLand(?UuidInterface $land): RelatieAdres
    {
        $this->land = $land;

        return $this;
    }
}