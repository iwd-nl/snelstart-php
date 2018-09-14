<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

class EmailVersturen extends BaseObject
{
    /**
     * Geeft aan (lezen/schrijven) of er email moet worden verstuurd.
     *
     * @var bool
     */
    private $shouldSend = false;

    /**
     * Het email adres waarnaar email moeten worden verstuurd.
     *
     * @var string|null
     */
    private $email;

    /**
     * Het (optionele) email adres waarnaar email moeten worden ge-Cc-eed.
     *
     * @var string|null
     */
    private $ccEmail;

    public static $editableAttributes = [
        "shouldSend",
        "email",
        "ccEmail"
    ];

    public function __construct(bool $shouldSend, ?string $email = null, ?string $ccEmail = null)
    {
        $this->shouldSend = $shouldSend;
        $this->email = $email;
        $this->ccEmail = $ccEmail;
    }

    /**
     * @return bool
     */
    public function isShouldSend(): bool
    {
        return $this->shouldSend;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return null|string
     */
    public function getCcEmail(): ?string
    {
        return $this->ccEmail;
    }
}