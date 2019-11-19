<?php

namespace SnelstartPHP\Request;

interface ODataRequestDataInterface
{
    public function getHttpCompatibleQueryString(): string;
}