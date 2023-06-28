<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use SnelstartPHP\Secure\BearerToken\BearerTokenInterface;

final class CachedAccessTokenConnection
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
     * @var LoggerInterface|null
     */
    private $logger;

    /**
     * Prefix to use to store the access token.
     */
    private const CACHE_ITEM_PREFIX = "snelstart.access_token.";

    /**
     * Allow a little wiggle room for the token expiry.
     */
    private const EXPIRES_AFTER_BUFFER = 60;

    public function __construct(AccessTokenConnection $accessTokenConnection, CacheItemPoolInterface $cacheItemPool, ?LoggerInterface $logger = null)
    {
        $this->connection = $accessTokenConnection;
        $this->cacheItemPool = $cacheItemPool;
        $this->logger = $logger;
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
            if ($this->logger !== null) {
                $this->logger->debug("[AccessToken] Successfully retrieved from cache.");
            }

            return $cacheItem->get();
        }

        if ($this->logger !== null) {
            $this->logger->debug("[AccessToken] Get an access token from Snelstart");
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

    protected function getItemKey(): string
    {
        return self::CACHE_ITEM_PREFIX . \spl_object_hash($this) . random_int(0, 99);
    }
}