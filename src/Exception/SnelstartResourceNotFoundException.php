<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Exception;

use GuzzleHttp\Exception\ClientException;

final class SnelstartResourceNotFoundException extends ClientException
{
}