<?php

namespace SnelstartPHP\Request;

interface ODataRequestDataInterface
{
    public function getFilter(): array;

    public function getApply(): array;

    public function setTop(int $top): ODataRequestDataInterface;

    public function getTop(): int;

    public function setSkip(int $skip): ODataRequestDataInterface;

    public function getSkip(): int;

    public function getHttpCompatibleQueryString(): string;
}