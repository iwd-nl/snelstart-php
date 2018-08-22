<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Model;

use Ramsey\Uuid\UuidInterface;

class FactuurRelatie extends BaseObject
{
    /**
     * De publieke sleutel (public identifier, als uuid) dat uniek een object identificeert.
     *
     * @var UuidInterface
     */
    private $id;

    /**
     * Geeft de realtieve uri terug van het object waartoe de identifier behoort.
     *
     * @var string
     */
    private $uri;

    public static $editableAttributes = [
        "id"
    ];

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     * @return FactuurRelatie
     */
    public function setId(UuidInterface $id): FactuurRelatie
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUri(): ?string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     * @return FactuurRelatie
     */
    public function setUri(string $uri): FactuurRelatie
    {
        $this->uri = $uri;

        return $this;
    }
}