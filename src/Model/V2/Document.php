<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model\V2;

use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\SnelstartObject;

final class Document extends SnelstartObject
{
    /**
     * De inhoud van de bijlage.
     *
     * @var string
     */
    protected $content;

    /**
     * De public identifier van de gekoppelde parent.
     *
     * @var UuidInterface
     */
    protected $parentIdentifier;

    /**
     * De naam van de bijlage.
     *
     * @var string
     */
    protected $fileName;

    /**
     * De bijlage is alleen-lezen.
     *
     * @var bool
     */
    protected $readOnly;

    public static $editableAttributes = [
        "id",
        "parentIdentifier",
        "content",
        "fileName",
    ];

    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content   Should contain base64 encoded data
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getParentIdentifier(): ?UuidInterface
    {
        return $this->parentIdentifier;
    }

    public function setParentIdentifier(UuidInterface $parentIdentifier): self
    {
        $this->parentIdentifier = $parentIdentifier;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function isReadOnly(): ?bool
    {
        return $this->readOnly;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public static function createFromFile(\SplFileObject $file, UuidInterface $parentIdentifier): self
    {
        if (!$file->isReadable()) {
            throw new \InvalidArgumentException("Given file is not readable");
        }

        return (new static())
            ->setFileName($file->getFilename())
            ->setParentIdentifier($parentIdentifier)
            ->setReadOnly(false)
            ->setContent(base64_encode($file->fread($file->getSize())));
    }
}