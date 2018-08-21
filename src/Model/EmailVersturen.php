<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

class EmailVersturen
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

    public function __construct(bool $shouldSend, ?string $email, ?string $ccEmail)
    {
        $this->shouldSend = $shouldSend;
        $this->email = $email;
        $this->ccEmail = $ccEmail;
    }
}