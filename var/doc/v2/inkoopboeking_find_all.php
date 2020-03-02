<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

$bearerToken = new \SnelstartPHP\Secure\BearerToken\ClientKeyBearerToken($clientKey);
$accessTokenConnection = new \SnelstartPHP\Secure\AccessTokenConnection($bearerToken);
$accessToken = $accessTokenConnection->getToken();

$connection = new \SnelstartPHP\Secure\V2Connector(
    new \SnelstartPHP\Secure\ApiSubscriptionKey($primaryKey, $secondaryKey),
    $accessToken
);

$boekingConnector = new \SnelstartPHP\Connector\V2\BoekingConnector($connection);

foreach ($boekingConnector->findInkoopfacturen(null, true) as $inkoopboeking) {
    var_dump($inkoopboeking);
}