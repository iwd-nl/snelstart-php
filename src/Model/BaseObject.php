<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

abstract class BaseObject
{
    public static $editableAttributes = [];

    public static function getEditableAttributes(): array
    {
        return \array_unique(\array_merge(self::$editableAttributes, static::$editableAttributes));
    }
}