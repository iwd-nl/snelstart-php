<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Ramsey\Uuid\UuidInterface;

abstract class SnelstartObject extends BaseObject
{
    /**
     * De publieke sleutel (public identifier, als uuid) dat uniek een object identificeert.
     *
     * @var UuidInterface
     */
    protected $id;

    /**
     * Geeft de realtieve uri terug van het object waartoe de identifier behoort.
     *
     * @var string
     */
    protected $uri;

    final public function __construct() {}

    public static $editableAttributes = [
        "id"
    ];

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function setId(UuidInterface $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function setUri(string $uri): self
    {
        $this->uri = $uri;

        return $this;
    }

    public static function getEditableAttributes(): array
    {
        return \array_unique(\array_merge(static::$editableAttributes, self::$editableAttributes));
    }

    /**
     * Check if one or more of the editable properties are not null. It is usually a good indicator if an entity
     * has been properly hydrated.
     */
    public function isHydrated(): bool
    {
        $hydrated = false;

        foreach (static::getEditableAttributes() as $editableAttribute) {
            try {
                /** @psalm-suppress RedundantCondition */
                if ($editableAttribute !== "id" && $editableAttribute !== "url" && !$hydrated) {
                    $possibleMethodNames = [ "get{$editableAttribute}", $editableAttribute ];

                    foreach ($possibleMethodNames as $possibleMethodName) {
                        if (method_exists($this, $possibleMethodName) && ($hydrated = $this->{$possibleMethodName}() !== null)) {
                            return true;
                        }
                    }
                }
            } catch (\TypeError $e) {
            }
        }

        return $hydrated;
    }

    /**
     * Create an object with the given UUID (handy if you already stored the UUID somewhere).
     *
     * @return static
     */
    public static function createFromUUID(UuidInterface $uuid): self
    {
        return (new static())->setId($uuid);
    }
}