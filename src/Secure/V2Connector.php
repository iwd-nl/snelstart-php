<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Secure;

use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;

final class V2Connector extends BaseConnection
{
    public function __construct(ApiSubscriptionKey $subscriptionKey, AccessToken $accessToken, ?LoggerInterface $logger = null, ?ClientInterface $client = null)
    {
        $this->subscriptionKey = $subscriptionKey;

        if ($client !== null) {
            parent::setClient($client);
        }

        if ($logger !== null) {
            parent::setLogger($logger);
        }

        parent::setAccessToken($accessToken);
    }

    public static function getEndpoint(): string
    {
        return "https://b2bapi.snelstart.nl/v2/";
    }
}