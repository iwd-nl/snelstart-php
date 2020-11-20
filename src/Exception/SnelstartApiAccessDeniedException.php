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
        return new self($e->getMessage(), $e->getRequest(), $e->getResponse(), $e, $e->getHandlerContext());
    }
}