<?php
declare(strict_types=1);

namespace SnelstartPHP\Tests\Request;

use SnelstartPHP\Model\Type\Relatiesoort;
use SnelstartPHP\Request\ODataRequestData;
use PHPUnit\Framework\TestCase;

class ODataRequestDataTest extends TestCase
{
    public function testODataRequestMerge()
    {
        $ODataRequestData = (new ODataRequestData())->setFilter([
            "testData"
        ]);

        $ODataRequestData->setFilter(\array_merge(
            $ODataRequestData->getFilter(),
            [ sprintf("Relatiesoort/any(soort:soort eq '%s')", Relatiesoort::LEVERANCIER()->getValue()) ])
        );

        $this->assertCount(2, $ODataRequestData->getFilter());
    }

    public function testODataWithMerge()
    {
        $ODataRequestData = new ODataRequestData();
        $ODataRequestData->setFilter(\array_merge(
            [ sprintf("Relatiesoort/any(soort:soort eq '%s')", Relatiesoort::LEVERANCIER()->getValue()) ])
        );

        $this->assertCount(1, $ODataRequestData->getFilter());
    }
}
