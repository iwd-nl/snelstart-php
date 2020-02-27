# Upgrade guide from 1.0 to 2.0
This release features a lot of changes to the internal code base and how to use them. The basic concepts still remains the same. In order to communicate with Snelstart you have to instantiate a connector and use the new model from Version 2.

Below you'll see a quick sample from before and after. This example will book an 'inkoopboeking' to the first supplier (leverancier) it finds.

## Previously
```php
$primaryKey = "<primary>";
$secondaryKey = "<secondary>";
$clientKey = "<maatwerksleutel>";
$grootboekNummer = "7002";

$bearerToken = new \SnelstartPHP\Secure\BearerToken\ClientKeyBearerToken($clientKey);
$accessTokenConnection = new \SnelstartPHP\Secure\AccessTokenConnection($bearerToken);
$accessToken = $accessTokenConnection->getToken();

$connection = new \SnelstartPHP\Secure\AuthenticatedConnection(
    new \SnelstartPHP\Secure\ApiSubscriptionKey($primaryKey, $secondaryKey),
    $accessToken
);

$boekingConnector = new \SnelstartPHP\Connector\BoekingConnector($connection);
$grootboekConnector = new \SnelstartPHP\Connector\GrootboekConnector($connection);
$leverancierConnector = new \SnelstartPHP\Connector\RelatieConnector($connection);
$leverancier = null;

/**
 * @var \SnelstartPHP\Model\Relatie $leverancier
 */
foreach ($leverancierConnector->findAllLeveranciers() as $leverancier) {
    break;
}

$inkoopGroot = $grootboekConnector->findByNumber($grootboekNummer);

if ($inkoopGroot === null) {
    throw new \DomainException(sprintf("There is no ledger for number %s", $grootboekNummer));
}

$invoiceAmountIncl = \Money\Money::EUR(1210);
// 21% tax
$invoiceAmountExcl = $invoiceAmountIncl->divide(121)->multiply(100);

$inkoopboeking = new \SnelstartPHP\Model\Inkoopboeking();
$inkoopboeking->setLeverancier($leverancier)
    ->setFactuurdatum(new \DateTimeImmutable())
    ->setFactuurnummer("inkoop-factuur-1")
    ->setFactuurbedrag($invoiceAmountIncl)
    ->setBoekingsregels([
        (new \SnelstartPHP\Model\Boekingsregel())
            ->setBedrag($invoiceAmountExcl)
            ->setOmschrijving("Description")
            ->setBtwSoort(\SnelstartPHP\Model\Type\BtwSoort::HOOG())
            ->setGrootboek($inkoopGroot)
    ])
    ->setBtw([
        (new \SnelstartPHP\Model\Btwregel(\SnelstartPHP\Model\Type\BtwRegelSoort::INKOPENHOOG(), $invoiceAmountIncl->subtract($invoiceAmountExcl)))
    ])
;

$inkoopboeking = $boekingConnector->addInkoopboeking($inkoopboeking);
$boekingConnector->addInkoopboekingBijlage($inkoopboeking);
```

## New situation
```php
$primaryKey = "<primary>";
$secondaryKey = "<secondary>";
$clientKey = "<maatwerksleutel>";
$grootboekNummer = "7002";

$bearerToken = new \SnelstartPHP\Secure\BearerToken\ClientKeyBearerToken($clientKey);
$accessTokenConnection = new \SnelstartPHP\Secure\AccessTokenConnection($bearerToken);
$accessToken = $accessTokenConnection->getToken();

$connection = new \SnelstartPHP\Secure\V2Connector(
    new \SnelstartPHP\Secure\ApiSubscriptionKey($primaryKey, $secondaryKey),
    $accessToken
);

$boekingConnector = new \SnelstartPHP\Connector\V2\BoekingConnector($connection);
$grootboekConnector = new \SnelstartPHP\Connector\V2\GrootboekConnector($connection);
$leverancierConnector = new \SnelstartPHP\Connector\V2\RelatieConnector($connection);
$leverancier = null;

/**
 * @var \SnelstartPHP\Model\V2\Relatie $leverancier
 */
foreach ($leverancierConnector->findAllLeveranciers() as $leverancier) {
    break;
}

$inkoopGroot = $grootboekConnector->findByNumber($grootboekNummer);

if ($inkoopGroot === null) {
    throw new \DomainException(sprintf("There is no ledger for number %s", $grootboekNummer));
}

$invoiceAmountIncl = \Money\Money::EUR(1210);
// 21% tax
$invoiceAmountExcl = $invoiceAmountIncl->divide(121)->multiply(100);

$inkoopboeking = new \SnelstartPHP\Model\V2\Inkoopboeking();
$inkoopboeking->setLeverancier($leverancier)
    ->setFactuurdatum(new \DateTimeImmutable())
    ->setFactuurnummer("inkoop-factuur-1")
    ->setFactuurbedrag($invoiceAmountIncl)
    ->setBoekingsregels([
        (new \SnelstartPHP\Model\Boekingsregel())
            ->setBedrag($invoiceAmountExcl)
            ->setOmschrijving("Description")
            ->setBtwSoort(\SnelstartPHP\Model\Type\BtwSoort::HOOG())
            ->setGrootboek($inkoopGroot)
    ])
    ->setBtw([
        (new \SnelstartPHP\Model\Btwregel(\SnelstartPHP\Model\Type\BtwRegelSoort::INKOPENHOOG(), $invoiceAmountIncl->subtract($invoiceAmountExcl)))
    ])
;

$boekingConnector->addInkoopboeking($inkoopboeking);
```