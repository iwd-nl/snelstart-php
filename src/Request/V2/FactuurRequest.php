<?php

namespace SnelstartPHP\Request\V2;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\V2\Inkoopfactuur;
use SnelstartPHP\Model\V2\Verkoopfactuur;
use SnelstartPHP\Request\ODataRequestDataInterface;

final class FactuurRequest
{
    public function findInkoopfactuur(Inkoopfactuur $inkoopfactuur): RequestInterface
    {
        if ($inkoopfactuur->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("GET", "inkoopfacturen/" . $inkoopfactuur->getId()->toString(), [
            "Content-Type"  =>  "application/json",
        ]);
    }

    public function findInkoopfacturen(ODataRequestDataInterface $ODataRequestData): RequestInterface
    {
        return new Request("GET", "inkoopfacturen?" . $ODataRequestData->getHttpCompatibleQueryString(), [
            "Content-Type"  =>  "application/json"
        ]);
    }

    public function findVerkoopfacturen(ODataRequestDataInterface $ODataRequestData): RequestInterface
    {
        return new Request("GET", "verkoopfacturen?" . $ODataRequestData->getHttpCompatibleQueryString(), [
            "Content-Type"  =>  "application/json"
        ]);
    }

    public function findVerkoopfactuur(Verkoopfactuur $verkoopfactuur): RequestInterface
    {
        if ($verkoopfactuur->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("GET", "verkoopfacturen/" . $verkoopfactuur->getId()->toString(), [
            "Content-Type"  =>  "application/json",
        ]);
    }

    public function getUBLForVerkoopfactuur(Verkoopfactuur $verkoopfactuur): RequestInterface
    {
        if ($verkoopfactuur->getId() === null) {
            throw PreValidationException::shouldHaveAnIdException();
        }

        return new Request("GET", sprintf("verkoopfacturen/%s/ubl", $verkoopfactuur->getId()->toString()));
    }
}