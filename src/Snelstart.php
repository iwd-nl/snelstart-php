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
    public const MAX_RESULTS = 500;

    // Only supports EUR
    public const CURRENCY = 'EUR';

    public static function getCurrency(): Currency
    {
        return new Currency(static::CURRENCY);
    }

    public static function getMoneyFormatter(): MoneyFormatter
    {
        if (static::$moneyFormatter === null) {
            static::$moneyFormatter = new DecimalMoneyFormatter(new ISOCurrencies());
        }

        return static::$moneyFormatter;
    }

    public static function getMoneyParser(): MoneyParser
    {
        if (static::$moneyParser === null) {
            static::$moneyParser = new DecimalMoneyParser(new ISOCurrencies());
        }

        return static::$moneyParser;
    }
}