<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Request;

use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Snelstart;

abstract class BaseRequest
{
    /**
     * Iterate over the Model objects and ask for the editable attributes. We will only serialize the editable fields
     * in this case.
     */
    protected static function prepareAddOrEditRequestForSerialization(BaseObject $object, array $editableAttributes = [])
    {
        $serialize = [];

        if (empty($editableAttributes)) {
            $editableAttributes = $object::getEditableAttributes();
        }

        foreach ($editableAttributes as $editableAttributeName) {
            $methodName = "get" . \ucfirst($editableAttributeName);

            if (!\method_exists($object, $methodName)) {
                continue;
            }

            $value = $object->{$methodName}();

            if ($value instanceof UuidInterface) {
                $value = (string) $value;
            } else if ($value instanceof \DateTimeInterface) {
                $value = $value->format(Snelstart::DATETIME_FORMAT);
            } elseif ($value instanceof Money) {
                $value = Snelstart::getMoneyFormatter()->format($value);
            } else if ($editableAttributeName === "id" && $value === null) {
                // Whenever 'id' equals null skip it.
                continue;
            } else if ($value instanceof \JsonSerializable || is_scalar($value) || $value === null) {
                // Do nothing since we accept these values.
            } else if (is_array($value)) {
                // Apply recursion...
                foreach ($value as &$subValue) {
                    if ($subValue instanceof BaseObject) {
                        $subValue = self::prepareAddOrEditRequestForSerialization($subValue);
                    }
                }

                // Else do nothing.
            } else if ($value instanceof SnelstartObject) {
                $editableSubAttributes = [];

                if ($value->getId() !== null) {
                    // Because it is an existing sub-object we only have to pass on the id.
                    $editableSubAttributes = ["id"];
                }

                $value = self::prepareAddOrEditRequestForSerialization($value, $editableSubAttributes);
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