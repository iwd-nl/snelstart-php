<?php

namespace SnelstartPHP\Tests\Request\V2;

use PHPUnit\Framework\TestCase;
use SnelstartPHP\Model\Type\VerkooporderStatus;
use SnelstartPHP\Model\V2\Verkooporder;
use SnelstartPHP\Request\V2\VerkooporderRequest;

class VerkooporderRequestTest extends TestCase
{
    private $verkooporderRequest;

    public function setUp(): void {
        $this->verkooporderRequest = new VerkooporderRequest();
    }

    public function testAddVerkooporderHasVerkooporderStatusUitgevoerd(): void {
        $verkooporder = new Verkooporder();
        $verkooporder->setVerkooporderStatus(VerkooporderStatus::UITGEVOERD());

        $expected = [
            "relatie" => null,
            "procesStatus" => null,
            "nummer" => null,
            "modifiedOn" => null,
            "datum" => null,
            "krediettermijn" => null,
            "omschrijving" => null,
            "betalingskenmerk" => null,
            "incassomachtiging" => null,
            "afleveradres" => null,
            "factuuradres" => null,
            "verkooporderBtwIngaveModel" => null,
            "kostenplaats" => null,
            "regels" => null,
            "memo" => null,
            "orderreferentie" => null,
            "factuurkorting" => null,
            "verkoopfactuur" => null,
            "verkoopordersjabloon" => null,
            "totaalExclusiefBtw" => "0.00",
            "totaalInclusiefBtw" => "0.00",
            "verkoopOrderStatus" => VerkooporderStatus::UITGEVOERD()->getValue(),
        ];
        $request = $this->verkooporderRequest->add($verkooporder);

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals(json_encode($expected), $request->getBody()->getContents());
    }
}