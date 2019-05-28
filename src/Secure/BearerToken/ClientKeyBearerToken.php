<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure\BearerToken;

final class ClientKeyBearerToken implements BearerTokenInterface
{
    /**
     * @var string
     */
    private $clientKey;

    public function __construct(string $clientKey)
    {
        $this->clientKey = $clientKey;

        return $this;
    }

    public function getFormParams(): array
    {
        return [
            "grant_type"    =>  "clientkey",
            "clientkey"     =>  $this->clientKey,
        ];
    }
}