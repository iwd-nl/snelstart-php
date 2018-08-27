<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Snelstart;

abstract class BaseRequest
{
    /**
     * Iterate over the Model objects and ask for the editable attributes. We will only serialize the editable fields
     * in this case.
     */
    protected static function prepareAddOrEditRequestForSerialization(BaseObject $object)
    {
        $serialize = [];

        foreach ($object::getEditableAttributes() as $editableAttributeName) {
            $methodName = "get" . \ucfirst($editableAttributeName);

            if (!\method_exists($object, $methodName)) {
                continue;
            }

            $value = $object->{$methodName}();

            if ($value instanceof UuidInterface) {
                $value = (string) $value;
            } else if ($value instanceof \DateTimeInterface) {
                $value = $value->format(Snelstart::DATETIME_FORMAT);
            } else if ($value instanceof \JsonSerializable || is_scalar($value) || is_array($value) || $value === null) {
                // Do nothing since we accept these values.
            } else if ($value instanceof BaseObject) {
                $value = self::prepareAddOrEditRequestForSerialization($value);
            } else {
                throw new \LogicException(sprintf(
                    "You need to implement something to handle the serialization of '%s' (type: %s)",
                    \get_class($value),
                    \gettype($value)
                ));
            }

            $serialize[$editableAttributeName] = $value;
        }

        return $serialize;
    }
}