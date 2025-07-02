<?php

namespace Mapper\V2\ArtikelMapper;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SnelstartPHP\Mapper\V2\ArtikelMapper;
use SnelstartPHP\Utils;

class ExtraVeldenTest extends TestCase
{
    public function testExtraVeldenAreSetOnArtikel(): void
    {
        $artikelData = [
            "extraVelden" => [
                [
                    "naam" => "Extra veld 1",
                    "waarde" => "Test value",
                ],
                [
                    "naam" => "Extra veld 2",
                    "waarde" => 100,
                ],
                [
                    "naam" => "Extra veld 3",
                    "waarde" => true,
                ],
            ],
        ];
        $artikelResponse = new Response(200, [], Utils::jsonEncode($artikelData));

        $artikel = (new ArtikelMapper())->find($artikelResponse);

        $extraVelden = $artikel->getExtraVelden();

        foreach ($artikelData["extraVelden"] as $extraVeld) {
            $this->assertArrayHasKey($extraVeld["naam"], $extraVelden);
            $this->assertEquals($extraVeld["waarde"], $extraVelden[$extraVeld["naam"]]);
        }
    }

    public function testExtraVeldenAreEmptyIfNotGiven(): void
    {
        $artikelData = [];
        $artikelResponse = new Response(200, [], Utils::jsonEncode($artikelData));

        $artikel = (new ArtikelMapper())->find($artikelResponse);

        $this->assertEmpty($artikel->getExtraVelden());
    }
}
