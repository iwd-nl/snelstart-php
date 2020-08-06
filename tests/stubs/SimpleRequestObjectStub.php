<?php

namespace SnelstartPHP\Tests\stubs;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\BaseObject;

class SimpleRequestObjectStub extends BaseObject {
    private $simpleValue = "test";
    private $nullValue = null;
    private $integerValue = 1;
    private $booleanValue = false;
    private $id;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getSimpleValue(): string
    {
        return $this->simpleValue;
    }

    public function getNullValue(): ?string
    {
        return $this->nullValue;
    }

    public function getIntegerValue(): int
    {
        return $this->integerValue;
    }

    public function getBooleanValue(): bool
    {
        return $this->booleanValue;
    }
};