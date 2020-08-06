<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @see https://b2bapi-developer.snelstart.nl/granttype_password
 */

namespace SnelstartPHP\Secure\BearerToken;

final class PasswordBearerToken implements BearerTokenInterface
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * The variable $koppelsleutel is according to the specs base64 encoded. Decode it and look for a ':'.
     */
    public function __construct(string $koppelsleutel)
    {
        $koppelsleutelParts = explode(":", base64_decode($koppelsleutel));

        if (count($koppelsleutelParts) !== 2) {
            throw new \InvalidArgumentException(sprintf("We expected 2 items while decoding this but we got %d", count($koppelsleutelParts)));
        }

        $this->username = $koppelsleutelParts[0];
        $this->password = $koppelsleutelParts[1];
    }

    public function getFormParams(): array
    {
        return [
            "grant_type"    =>  "password",
            "username"      =>  $this->username,
            "password"      =>  $this->password,
        ];
    }
}