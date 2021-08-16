<?php

require_once __DIR__.'/../../../vendor/autoload.php';
require_once __DIR__.'/../config.php';

$bearerToken = new \SnelstartPHP\Secure\BearerToken\ClientKeyBearerToken($clientKey);
$accessTokenConnection = new \SnelstartPHP\Secure\AccessTokenConnection($bearerToken);
$accessToken = $accessTokenConnection->getToken();

$connection = new \SnelstartPHP\Secure\V2Connector(
    new \SnelstartPHP\Secure\ApiSubscriptionKey($primaryKey, $secondaryKey),
    $accessToken
);

$btwTariefConnector = new \SnelstartPHP\Connector\V2\BtwTariefConnector($connection);

foreach ($btwTariefConnector->findAll() as $btwTarief) {
    echo vsprintf("soort=%s percentage=%s datum_vanaf=%s tot_en_met=%s\n", [
        $btwTarief->getBtwSoort()->getValue(),
        $btwTarief->getBtwPercentage(),
        $btwTarief->getDatumVanaf()->format('Y-m-d'),
        $btwTarief->getDatumTotEnMet()->format('Y-m-d'),
    ]);
}
