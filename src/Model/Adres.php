<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

final class Adres extends BaseObject
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
     * @var Land|null
     */
    protected $land;

    /**
     * @var string[]
     */
    public static $editableAttributes = [
        "contactpersoon",
        "straat",
        "postcode",
        "plaats",
        "land",
    ];

    /**
     * @return null|string
     */
    public function getContactpersoon(): ?string
    {
        return $this->contactpersoon;
    }

    public function setContactpersoon(?string $contactpersoon): self
    {
        $this->contactpersoon = $contactpersoon;

        return $this;
    }

    public function getStraat(): ?string
    {
        return $this->straat;
    }

    public function setStraat(?string $straat): self
    {
        $this->straat = $straat;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getPlaats(): ?string
    {
        return $this->plaats;
    }

    public function setPlaats(?string $plaats): self
    {
        $this->plaats = $plaats;

        return $this;
    }

    public function getLand(): ?Land
    {
        return $this->land;
    }

    public function setLand(?Land $land): self
    {
        $this->land = $land;

        return $this;
    }
}