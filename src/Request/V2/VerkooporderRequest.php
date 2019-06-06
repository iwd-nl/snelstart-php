<?php
/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use SnelstartPHP\Model\V2\Verkooporder;
use SnelstartPHP\Request\BaseRequest;

final class VerkooporderRequest extends BaseRequest
{
    public static function add(Verkooporder $verkooporder): RequestInterface
    {
        return new Request("POST", "verkooporders", [
            "Content-Type"  =>  "application/json"
        ], \GuzzleHttp\json_encode(self::prepareAddOrEditRequestForSerialization($verkooporder)));
    }
}