<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Exception;

use GuzzleHttp\Exception\BadResponseException;

final class SnelstartApiAccessDeniedException extends BadResponseException
{
    public static function createFromParent(BadResponseException $e): self
    {
        try {
            return new self($body["error"] ?? $e->getMessage(), $e->getRequest(), $e->getResponse(), $e, $e->getHandlerContext());
        } catch (\InvalidArgumentException $exception) {
            return new self($e->getMessage(), $e->getRequest(), $e->getResponse(), $e, $e->getHandlerContext());
        }
    }
}