<?php
/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request\V2;

use function \http_build_query;
use function \array_filter;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\V2\Relatie;
use SnelstartPHP\Request\BaseRequest;
use SnelstartPHP\Request\ODataRequestDataInterface;

final class ArtikelRequest extends BaseRequest
{
    public function findAll(ODataRequestDataInterface $ODataRequestData, ?Relatie $relatie = null, ?int $aantal = null): RequestInterface
    {
        return new Request("GET", "artikelen?" . $ODataRequestData->getHttpCompatibleQueryString() . '&' . $this->getQueryString($relatie, $aantal));
    }

    public function find(UuidInterface $id, ODataRequestDataInterface $ODataRequestData, ?Relatie $relatie = null, ?int $aantal = null): RequestInterface
    {
        return new Request("GET", sprintf("artikelen/%s/?%s", $id->toString(), $ODataRequestData->getHttpCompatibleQueryString() . '&' . $this->getQueryString($relatie, $aantal)));
    }

    public function getCustomFields(UuidInterface $id): RequestInterface
    {
        return new Request("GET", sprintf("artikelen/%s/customFields", $id->toString()));
    }

    protected function getQueryString(?Relatie $relatie = null, ?int $aantal = null): string
    {
        $relatieId = null;

        if ($relatie !== null && $relatie->getId() !== null) {
            $relatieId = $relatie->getId()->toString();
        }

        return http_build_query(array_filter([
            "relatieId" =>  $relatieId,
            "aantal"    =>  $aantal,
        ], static function($value) {
            return $value !== null;
        }), "", "&", \PHP_QUERY_RFC3986);
    }
}