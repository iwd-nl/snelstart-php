<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Model\V1;

use Ramsey\Uuid\UuidInterface;
/**
 * @deprecated
 */

final class InkoopboekingBijlage extends Bijlage
{
    /**
     * @var UuidInterface|null
     */
    private $inkoopBoekingId;

    public static $editableAttributes = [
        "inkoopBoekingId",
    ];

    public static function getEditableAttributes(): array
    {
        return \array_unique(
            \array_merge(parent::$editableAttributes, parent::getEditableAttributes(), static::$editableAttributes, self::$editableAttributes)
        );
    }

    public function getInkoopBoekingId(): ?UuidInterface
    {
        return $this->inkoopBoekingId;
    }

    public function getInkoopBoeking(): ?Inkoopboeking
    {
        if ($this->inkoopBoekingId === null) {
            return null;
        }

        return Inkoopboeking::createFromUUID($this->inkoopBoekingId);
    }

    public function setInkoopBoekingId(UuidInterface $inkoopBoekingId): self
    {
        $this->inkoopBoekingId = $inkoopBoekingId;

        return $this;
    }
}