<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure;

use SnelstartPHP\Secure\BearerToken\BearerTokenInterface;

final class AccessToken implements \JsonSerializable
{
    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var string
     */
    protected $tokenType;

    /**
     * @var int
     */
    protected $expires;

    /**
     * @var BearerTokenInterface
     */
    protected $bearerToken;

    public function __construct(array $options, BearerTokenInterface $bearerToken)
    {
        if (empty($options['access_token'])) {
            throw new \InvalidArgumentException('Required option not passed: "access_token"');
        }

        if (empty($options['expires_in']) || !is_numeric($options['expires_in'])) {
            throw new \InvalidArgumentException('expires_in value must be an integer');
        }

        $this->bearerToken = $bearerToken;
        $this->accessToken = $options['access_token'];
        $this->tokenType = $options['token_type'] ?? 'bearer';
        $this->expires = $options['expires_in'] !== 0 ? time() + intval($options['expires_in']) : 0;
    }

    public function getExpiresIn(): int
    {
        return $this->expires - time();
    }

    public function isExpired(): bool
    {
        return $this->getExpiresIn() < 1;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getBearerToken(): BearerTokenInterface
    {
        return $this->bearerToken;
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function jsonSerialize(): array
    {
        return [
            'access_token'  =>  $this->accessToken,
            'token_type'    =>  $this->tokenType,
            'expires_in'    =>  $this->getExpiresIn(),
            'expires'       =>  $this->expires,
        ];
    }

    public function __toString(): string
    {
        return $this->getAccessToken();
    }
}