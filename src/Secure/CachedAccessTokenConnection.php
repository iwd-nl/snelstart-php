<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure;

use Psr\Cache\CacheItemPoolInterface;
use SnelstartPHP\Secure\BearerToken\BearerTokenInterface;

class CachedAccessTokenConnection
{
    /**
     * @var AccessTokenConnection
     */
    private $connection;

    /**
     * @var CacheItemPoolInterface
     */
    private $cacheItemPool;

    /**
     * Prefix to use to store the access token.
     */
    private const CACHE_ITEM_PREFIX = "snelstart.access_token.";

    /**
     * Allow a little wiggle room for the token expiry.
     */
    private const EXPIRES_AFTER_BUFFER = 60;

    public function __construct(AccessTokenConnection $accessTokenConnection, CacheItemPoolInterface $cacheItemPool)
    {
        $this->connection = $accessTokenConnection;
        $this->cacheItemPool = $cacheItemPool;
    }

    /**
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken(?BearerTokenInterface $bearerToken = null): AccessToken
    {
        $cacheItem = $this->cacheItemPool->getItem($this->getItemKey());

        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $accessToken = $this->connection->getToken($bearerToken);
        $cacheItem
            ->set($accessToken)
            ->expiresAfter($accessToken->getExpiresIn() - self::EXPIRES_AFTER_BUFFER);

        if (!$this->cacheItemPool->save($cacheItem)) {
            throw new \RuntimeException("Something went wrong trying to persist the access token into cache.");
        }

        return $accessToken;
    }

    public function getEndpoint(): string
    {
        return $this->connection->getEndpoint();
    }

    protected function getItemKey(): string
    {
        return self::CACHE_ITEM_PREFIX . \spl_object_hash($this) . mt_rand(0, 99);
    }
}