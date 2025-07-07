<?php

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use SnelstartPHP\Request\BaseRequest;

final class DagboekenRequest extends BaseRequest
{
    public function findAll(): RequestInterface
    {
        return new Request("GET", "dagboeken");
    }
}
