<?php

namespace SnelstartPHP\Tests\Request\V2;

use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Model\V2\Inkoopboeking;
use SnelstartPHP\Request\V2\BoekingRequest;
use PHPUnit\Framework\TestCase;

class BoekingRequestTest extends TestCase
{
    private $boekingRequest;

    public function setUp(): void
    {
        $this->boekingRequest = new BoekingRequest();
    }

    public function testAddInkoopboeking(): void
    {
        $uuid = Uuid::uuid4();

        $inkoopboeking = Inkoopboeking::createFromUUID($uuid);
        $inkoopboeking->setFactuurnummer('123456');
        $inkoopboeking->setFactuurbedrag(new Money(2000, new Currency('EUR')));

        $expected = [
            "id" => $uuid->toString(),
            "boekstuk" => null,
            "gewijzigdDoorAccountant" => false,
            "markering" => false,
            "factuurDatum" => null,
            "factuurnummer" => "123456",
            "omschrijving" => null,
            "factuurBedrag" => "20.00",
            "boekingsregels" => [],
            "vervalDatum" => null,
            "btw" => [],
            "documents" =>[],
            "leverancier" =>null,
        ];
        $request = $this->boekingRequest->addInkoopboeking($inkoopboeking);

        $this->assertEquals('POST', $request->getMethod());

        $this->assertEquals('inkoopboekingen', $request->getUri());
        $this->assertJsonStringEqualsJsonString(
            json_encode($expected),
            $request->getBody()->getContents()
        );
    }
}
