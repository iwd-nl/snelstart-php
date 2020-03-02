<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Model\V1;

use SnelstartPHP\Model\SnelstartObject;

/**
 * @deprecated
 */
abstract class Bijlage extends SnelstartObject
{
    /**
     * De inhoud van de bijlage.
     *
     * @var string
     */
    protected $content;

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
    protected $readOnly = true;

    public static $editableAttributes = [
        "id",
        "content",
        "fileName",
        "readOnly",
    ];

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function isReadOnly(): bool
    {
        return $this->readOnly;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public static function createFromFile(\SplFileObject $file): self
    {
        if (!$file->isReadable()) {
            throw new \InvalidArgumentException("Given file is not readable");
        }

        return (new static())
            ->setFileName($file->getFilename())
            ->setReadOnly(false)
            ->setContent(base64_encode($file->fread($file->getSize())));
    }
}