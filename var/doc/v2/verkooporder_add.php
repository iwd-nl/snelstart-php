<?php

use SnelstartPHP\Request\ODataRequestData;

require_once __DIR__.'/../../../vendor/autoload.php';
require_once __DIR__.'/../config.php';

// Prerequisites
// Relation with id 2
// Article with code 308

$bearerToken = new \SnelstartPHP\Secure\BearerToken\ClientKeyBearerToken($clientKey);
$accessTokenConnection = new \SnelstartPHP\Secure\AccessTokenConnection($bearerToken);
$accessToken = $accessTokenConnection->getToken();

$connection = new \SnelstartPHP\Secure\V2Connector(
    new \SnelstartPHP\Secure\ApiSubscriptionKey($primaryKey, $secondaryKey),
    $accessToken
);

$klantConnector = new \SnelstartPHP\Connector\V2\RelatieConnector($connection);
$searchFilter = (new ODataRequestData())->setFilter([
    sprintf('Relatiecode eq %s', 2)
]);
$klant = $klantConnector->findAllKlanten($searchFilter, true)->current();
$artikelConnector = new \SnelstartPHP\Connector\V2\ArtikelConnector($connection);
$requestData = new \SnelstartPHP\Request\ODataRequestData();
$requestData->setFilter([ "Artikelcode eq '308'" ]);
$requestData->setTop(25);
$artikelen = $artikelConnector->findAll($requestData, true, null, $klant);
$verkooporder = new \SnelstartPHP\Model\V2\Verkooporder();
$lines = [];

foreach ($artikelen as $artikel) {
    $lines[] = (new \SnelstartPHP\Model\V2\VerkooporderRegel())
        ->setAantal(1)
        ->setArtikel($artikel)
        ->calculateAndSetTotaal()
    ;

    break;
}

$verkooporder
    ->setRelatie($klant)
    ->setDatum(new DateTimeImmutable('now', new DateTimeZone('Europe/Amsterdam')))
    ->setProcesStatus(\SnelstartPHP\Model\Type\ProcesStatus::ORDER())
    ->setVerkooporderBtwIngaveModel(\SnelstartPHP\Model\Type\VerkooporderBtwIngave::EXCLUSIEF())
    ->setKrediettermijn(14)
    ->setOmschrijving("Week 50")
    ->setRegels(...$lines)
;

$verkoopboekingConnector = new \SnelstartPHP\Connector\V2\VerkooporderConnector($connection);
$verkoopboekingConnector->add($verkooporder);