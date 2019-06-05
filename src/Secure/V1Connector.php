<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Secure;

use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;

final class V1Connector extends BaseConnection
{
    public function __construct(ApiSubscriptionKey $subscriptionKey, AccessToken $accessToken, ?LoggerInterface $logger = null, ?ClientInterface $client = null)
    {
        $this->subscriptionKey = $subscriptionKey;

        if ($client !== null) {
            $this->setClient($client);
        }

        if ($logger !== null) {
            $this->setLogger($logger);
        }

        $this->setAccessToken($accessToken);
    }

    public function getEndpoint(): string
    {
        return "https://b2bapi.snelstart.nl/v1/";
    }
}