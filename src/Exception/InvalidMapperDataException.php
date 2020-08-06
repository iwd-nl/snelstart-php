<?php

namespace SnelstartPHP\Exception;

final class InvalidMapperDataException extends \LogicException
{
    public static function mandatoryKeysAreMissing(string ...$keys): self
    {
        throw new self(sprintf("The following mandatory keys were missing: %s", implode(",", $keys)));
    }
}