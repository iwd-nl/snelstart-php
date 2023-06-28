<?php
declare(strict_types=1);

namespace SnelstartPHP\Tests\Model\V2;

use Money\Money;
use SnelstartPHP\Model\V2\VerkooporderRegel;
use PHPUnit\Framework\TestCase;

class VerkooporderRegelTest extends TestCase
{
    public function testCalculateDoesNotMutateValuesInSetters(): void
    {
        $stuksprijs = Money::EUR(1000);
        $aantal = 1;
        $verkooporderregel = (new VerkooporderRegel())->setStuksprijs($stuksprijs)->setAantal($aantal);

        $this->assertEquals($stuksprijs, $verkooporderregel->getStuksprijs());
        $this->assertEquals($aantal, $verkooporderregel->getAantal());
    }

    public function testCalculateAndSetTotaalWithPartialAmount(): void
    {
        $stuksprijs = Money::EUR(1000);
        $aantal = 1.25;
        $verkooporderregel = (new VerkooporderRegel())
            ->setStuksprijs($stuksprijs)
            ->setAantal($aantal);

        $this->assertEquals(Money::EUR(0), $verkooporderregel->getTotaal());
        $this->assertEquals(Money::EUR(1250), $verkooporderregel->calculateAndSetTotaal()->getTotaal());
    }

    public function testCalculateAndSetTotaalWithFullAmount(): void
    {
        $stuksprijs = Money::EUR(1000);
        $aantal = 1;
        $verkooporderregel = (new VerkooporderRegel())
            ->setStuksprijs($stuksprijs)
            ->setAantal($aantal);

        $this->assertEquals(Money::EUR(0), $verkooporderregel->getTotaal());
        $this->assertEquals(Money::EUR(1000), $verkooporderregel->calculateAndSetTotaal()->getTotaal());
    }
}
