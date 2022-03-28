<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;
use Money\MoneyFormatter;
use Money\MoneyParser;
use Money\Parser\DecimalMoneyParser;

final class Snelstart
{
    /**
     * @var MoneyFormatter|null
     */
    private static $moneyFormatter;

    /**
     * @var MoneyParser|null
     */
    private static $moneyParser;

    // Example: 2018-08-07T06:24:48.12
    public const DATETIME_FORMAT = "Y-m-d\TH:i:s.u";

    // Maximum results that will be returned on GET operations
    public const MAX_RESULTS = 25;

    // Only supports EUR
    public const CURRENCY = 'EUR';

    public static function getCurrency(): Currency
    {
        return new Currency(self::CURRENCY);
    }

    public static function getMoneyFormatter(): MoneyFormatter
    {
        if (self::$moneyFormatter === null) {
            self::$moneyFormatter = new DecimalMoneyFormatter(new ISOCurrencies());
        }

        return self::$moneyFormatter;
    }

    public static function getMoneyParser(): MoneyParser
    {
        if (self::$moneyParser === null) {
            self::$moneyParser = new DecimalMoneyParser(new ISOCurrencies());
        }

        return self::$moneyParser;
    }
}