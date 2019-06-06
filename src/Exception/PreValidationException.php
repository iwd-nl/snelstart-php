<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Exception;

final class PreValidationException extends \RuntimeException
{
    public static function textLengthException(int $current, int $max): self
    {
        throw new self(sprintf("The size of the text exceeds the maximum of %d, current length %d", $max, $current));
    }

    public static function unexpectedIdException(): self
    {
        return new self("This object is not allowed to have an ID yet.");
    }

    public static function shouldHaveAnIdException(): self
    {
        return new self(" This object has to have an ID in order to continue.");
    }
}