<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

require_once __DIR__ . '/../../../vendor/autoload.php';

$primaryKey = "<primary>";
$secondaryKey = "<secondary>";
$clientKey = "<maatwerksleutel>";

$bearerToken = new \SnelstartPHP\Secure\BearerToken\ClientKeyBearerToken($clientKey);
$accessTokenConnection = new \SnelstartPHP\Secure\AccessTokenConnection($bearerToken);
$accessToken = $accessTokenConnection->getToken();

$connection = new \SnelstartPHP\Secure\V1Connector(
    new \SnelstartPHP\Secure\ApiSubscriptionKey($primaryKey, $secondaryKey),
    $accessToken
);

$boekingConnector = new \SnelstartPHP\Connector\V1\BoekingConnector($connection);

foreach ($boekingConnector->findInkoopfactuur(null, true) as $inkoopboeking) {
    var_dump($inkoopboeking);
}