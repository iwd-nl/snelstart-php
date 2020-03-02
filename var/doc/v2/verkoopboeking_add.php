<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

global $ledgers;

$client = new \GuzzleHttp\Client([
    //"proxy"     =>  "http://proxy.host:8888",
    "base_uri"  =>  \SnelstartPHP\Secure\V2Connector::getEndpoint(),
    "verify"    =>  false,
]);

$bearerToken = new \SnelstartPHP\Secure\BearerToken\ClientKeyBearerToken($clientKey);
$accessTokenConnection = new \SnelstartPHP\Secure\AccessTokenConnection($bearerToken);
$accessToken = $accessTokenConnection->getToken();

$connection = new \SnelstartPHP\Secure\V2Connector(
    new \SnelstartPHP\Secure\ApiSubscriptionKey($primaryKey, $secondaryKey),
    $accessToken,
    null,
    $client
);

$grootboekConnector = new \SnelstartPHP\Connector\V2\GrootboekConnector($connection);
$leverancierConnector = new \SnelstartPHP\Connector\V2\RelatieConnector($connection);
$klant = null;

/**
 * @var \SnelstartPHP\Model\V2\Relatie $klant
 */
foreach ($leverancierConnector->findAllKlanten() as $klant) {
    break;
}

$omzetDienstenGroot = $grootboekConnector->findByNumber($ledgers["omzetDienstenGroot"]);

if ($omzetDienstenGroot === null) {
    throw new \DomainException(sprintf("There is no ledger for number %s", $ledgers["omzetDienstenGroot"]));
}

$invoiceAmountIncl = \Money\Money::EUR(1210);
// 21% tax
$invoiceAmountExcl = $invoiceAmountIncl->divide(121)->multiply(100);

$verkoopboeking = new \SnelstartPHP\Model\V2\Verkoopboeking();
$verkoopboeking->setKlant($klant)
    ->setFactuurdatum(new \DateTimeImmutable())
    ->setVervaldatum(new \DateTimeImmutable("+14 days"))
    ->setFactuurnummer("verkoop-factuur-1")
    ->setFactuurbedrag($invoiceAmountIncl)
    ->setBoekingsregels(...[
        (new \SnelstartPHP\Model\V2\Boekingsregel())
            ->setBedrag($invoiceAmountExcl)
            ->setOmschrijving("Description")
            ->setBtwSoort(\SnelstartPHP\Model\Type\BtwSoort::HOOG())
            ->setGrootboek($omzetDienstenGroot)
    ])
    ->setBtw(...[
        (new \SnelstartPHP\Model\V2\Btwregel(
            \SnelstartPHP\Model\Type\BtwRegelSoort::VERKOPENHOOG(),
            $invoiceAmountIncl->subtract($invoiceAmountExcl)
        ))
    ])
;

$boekingConnector = new \SnelstartPHP\Connector\V2\BoekingConnector($connection);
$verkoopboeking = $boekingConnector->addVerkoopboeking($verkoopboeking);
var_dump($verkoopboeking);

echo "Successfully added: " . $verkoopboeking->getUri() . "\n";
$document = \SnelstartPHP\Model\V2\Document::createFromFile(
    new SplFileObject(__DIR__ . '/../example.pdf'),
    $verkoopboeking->getId()
);
$document = $boekingConnector->addVerkoopboekingDocument($verkoopboeking, $document);
echo "Successfully added: " . $document->getUri() . "\n";