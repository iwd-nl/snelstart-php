<?php

namespace SnelstartPHP\Model;

use function \array_unique;
use function \array_merge;

abstract class BaseObject
{
    /**
     * @var string[]
     */
    public static $editableAttributes = [];

    public static function getEditableAttributes(): array
    {
        return array_unique(array_merge(self::$editableAttributes, static::$editableAttributes));
    }
}