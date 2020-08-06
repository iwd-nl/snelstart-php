<?php

namespace SnelstartPHP\Request;

use Money\Money;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Serializer\RequestSerializerInterface;
use SnelstartPHP\Serializer\SnelstartRequestRequestSerializer;

abstract class BaseRequest
{
    /**
     * @var RequestSerializerInterface
     */
    protected $serializer;

    public function __construct(?RequestSerializerInterface $serializer = null)
    {
        $this->serializer = $serializer ?? new SnelstartRequestRequestSerializer();
    }

    /**
     * Iterate over the Model objects and ask for the editable attributes. We will only serialize the editable fields
     * in this case.
     *
     * @param BaseObject $object
     * @param string[]   $editableAttributes
     * @return array
     */
    public function prepareAddOrEditRequestForSerialization(BaseObject $object, string ...$editableAttributes): array
    {
        $serialize = [];

        if (count($editableAttributes) === 0) {
            $editableAttributes = $object::getEditableAttributes();
        }

        foreach ($editableAttributes as $editableAttributeName) {
            $methodExists = false;
            $methodName = null;
            $methodNames = [
                "get" . \ucfirst($editableAttributeName),
                "is" . \ucfirst($editableAttributeName),
            ];

            foreach ($methodNames as $methodName) {
                if (\method_exists($object, $methodName)) {
                    $methodExists = true;
                    break;
                }
            }

            if (!$methodExists) {
                \trigger_error(sprintf("There is no method (get or is) on object %s for property %s", get_class($object), $editableAttributeName), \E_USER_NOTICE);
                continue;
            }

            $value = $object->{$methodName}();

            if ($value instanceof UuidInterface) {
                $value = $this->serializer->uuidInterfaceToString($value);
            } else if ($value instanceof \DateTimeInterface) {
                $value = $this->serializer->dateTimeToString($value);
            } elseif ($value instanceof Money) {
                $value = $this->serializer->moneyFormatToString($value);
            } else if ($editableAttributeName === "id" && $value === null) {
                // Whenever 'id' equals null skip it.
                $this->serializer->scalarValue($value);
                continue;
            } else if ($value instanceof \JsonSerializable || is_scalar($value) || $value === null) {
                // We accept simple values.
                $value = $this->serializer->scalarValue($value);
            } else if (is_array($value)) {
                // If our value is an array and contains anything that is an instance of 'BaseObject'
                // Try to serialize that again. Please note that this is done by reference.
                foreach ($value as &$subValue) {
                    if ($subValue instanceof BaseObject) {
                        $subValue = $this->prepareAddOrEditRequestForSerialization($subValue);
                    }
                }

                // Else do nothing.
                $value = $this->serializer->arrayValue($value);
            } else if ($value instanceof SnelstartObject) {
                $editableSubAttributes = [];

                if ($value->getId() !== null) {
                    // Because it is an existing sub-object we only have to pass the id.
                    $editableSubAttributes = ["id"];
                }

                $value = $this->prepareAddOrEditRequestForSerialization($value, ...$editableSubAttributes);
            } else if ($value instanceof BaseObject) {
                $value = $this->prepareAddOrEditRequestForSerialization($value);
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