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

$connection = new \SnelstartPHP\Secure\AuthenticatedConnection(
    new \SnelstartPHP\Secure\ApiSubscriptionKey($primaryKey, $secondaryKey),
    $accessToken
);

$leverancierConnector = new \SnelstartPHP\Connector\RelatieConnector($connection);
$leverancier = null;

/**
 * @var \SnelstartPHP\Model\Relatie $leverancier
 */
foreach ($leverancierConnector->findAllLeveranciers() as $leverancier) {
    break;
}

$grootboekConnector = new \SnelstartPHP\Connector\GrootboekConnector($connection);
$inkoopGroot = \SnelstartPHP\Util\IteratorUtil::getFirstElementOrNull($grootboekConnector->findAll(
    (new \SnelstartPHP\Request\ODataRequestData())->setFilter(["Nummer eq 7002"]))
);

$inkoopboeking = new \SnelstartPHP\Model\Inkoopboeking();
$inkoopboeking->setLeverancier($leverancier)
    ->setFactuurdatum(new \DateTime())
    ->setFactuurnummer("inkoop-factuur-1")
    ->setFactuurbedrag(\Money\Money::EUR(1223))
    ->setBoekingsregels([
        (new \SnelstartPHP\Model\Boekingsregel())
            ->setBedrag(\Money\Money::EUR(1011))
            ->setOmschrijving("Omschrijving")
            ->setBtwSoort(\SnelstartPHP\Model\Type\BtwSoort::HOOG())
            ->setGrootboek($inkoopGroot)
    ])
    ->setBtw([
        (new \SnelstartPHP\Model\Btwregel(\SnelstartPHP\Model\Type\BtwRegelSoort::INKOPENHOOG(), \Money\Money::EUR(212)))
    ])
;

$boekingConnector = new \SnelstartPHP\Connector\BoekingConnector($connection);
$boekingConnector->addInkoopboeking($inkoopboeking);