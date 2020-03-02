<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Model\V1;

/**
 * @deprecated
 */
class Inkoopboeking extends Boeking
{
    /**
     * De leverancier/crediteur van wie de factuur afkomstig is.
     *
     * @var Relatie
     */
    private $leverancier;

    /**
     * @var InkoopboekingBijlage[]
     */
    protected $bijlagen;

    public static $editableAttributes = [
        "leverancier",
    ];

    public static function getEditableAttributes(): array
    {
        return \array_unique(
            \array_merge(parent::$editableAttributes, parent::getEditableAttributes(), static::$editableAttributes, self::$editableAttributes)
        );
    }

    public function getLeverancier(): ?Relatie
    {
        return $this->leverancier;
    }

    public function setLeverancier(Relatie $leverancier): self
    {
        $this->leverancier = $leverancier;

        return $this;
    }
}