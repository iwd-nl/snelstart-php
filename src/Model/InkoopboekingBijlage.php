<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Ramsey\Uuid\UuidInterface;

class InkoopboekingBijlage extends Bijlage
{
    /**
     * @var UuidInterface
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