<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Exception;

use Throwable;

class RateLimitException extends \RuntimeException
{
    public function __construct($message = "Rate Limit for the API has been reached", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}