<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Exception;

use GuzzleHttp\Exception\BadResponseException;

class SnelstartApiAccessDeniedException extends BadResponseException
{
    static public function createFromParent(BadResponseException $e): self
    {
        try {
            throw new self($body["error"] ?? $e->getMessage(), $e->getRequest(), $e->getResponse(), $e, $e->getHandlerContext());
        } catch (\InvalidArgumentException $exception) {
            throw new self($e->getMessage(), $e->getRequest(), $e->getResponse(), $e, $e->getHandlerContext());
        }
    }
}