<?php

namespace SnelstartPHP\Serializer;

use Money\Money;
use Ramsey\Uuid\UuidInterface;

interface RequestSerializerInterface
{
    public function uuidInterfaceToString(UuidInterface $uuid): string;

    public function dateTimeToString(\DateTimeInterface $dateTime): string;

    public function moneyFormatToString(Money $money): string;

    /**
     * @template T
     * @psalm-param T $value
     * @psalm-return T
     */
    public function scalarValue($value);

    public function arrayValue(array $value): array;
}