<?php

namespace SnelstartPHP\Serializer;

use Money\Money;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Snelstart;

final class SnelstartRequestRequestSerializer implements RequestSerializerInterface
{
    public function uuidInterfaceToString(UuidInterface $uuid): string
    {
        return $uuid->toString();
    }

    public function dateTimeToString(\DateTimeInterface $dateTime): string
    {
        return $dateTime->format(Snelstart::DATETIME_FORMAT);
    }

    public function moneyFormatToString(Money $money): string
    {
        return Snelstart::getMoneyFormatter()->format($money);
    }

    /**
     * @inheritDoc
     */
    public function scalarValue($value)
    {
        return $value;
    }

    public function arrayValue(array $value): array
    {
        return $value;
    }
}