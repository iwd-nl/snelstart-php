<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @see https://b2bapi-developer.snelstart.nl/odata
 */

namespace SnelstartPHP\Request;

use SnelstartPHP\Snelstart;

class ODataRequestData
{
    /**
     * @var array
     */
    private $filter = [];

    /**
     * @var array
     */
    private $apply = [];

    /**
     * @var int|null
     */
    private $top = Snelstart::MAX_RESULTS;

    /**
     * @var int|null
     */
    private $skip = 0;

    /**
     * @var string
     */
    private $filterMode = self::FILTER_MODE_AND;

    public const FILTER_MODE_OR = "or";

    public const FILTER_MODE_AND = "and";

    public function getFilter(): array
    {
        return $this->filter;
    }

    public function setFilter(array $filter, string $mode = self::FILTER_MODE_AND): self
    {
        $this->filter = $filter;

        if (!\in_array($mode, [ self::FILTER_MODE_OR, self::FILTER_MODE_AND ])) {
            throw new \BadMethodCallException("We expected either 'and' or 'or'.");
        }

        return $this;
    }

    public function getApply(): array
    {
        return $this->apply;
    }

    public function setApply(array $apply): self
    {
        $this->apply = $apply;

        return $this;
    }

    public function getTop(): ?int
    {
        return $this->top;
    }

    public function setTop(?int $top): self
    {
        $this->top = $top;

        return $this;
    }

    public function getSkip(): ?int
    {
        return $this->skip;
    }

    public function setSkip(?int $skip): self
    {
        $this->skip = $skip;

        return $this;
    }

    public function getHttpCompatibleQueryString(): string
    {
        $collection = [];

        if (!empty($this->getFilter())) {
            $collection['$filter'] = implode(sprintf(" %s ", $this->filterMode), $this->getFilter());
        }

        if (!empty($this->getTop())) {
            $collection['$top'] = $this->getTop();
        }

        if (!empty($this->getSkip())) {
            $collection['$skip'] = $this->getSkip();
        }

        if (!empty($this->getApply())) {
            $collection['$apply'] = $this->getApply();
        }

        if (empty($collection)) {
            return "";
        }

        return \http_build_query($collection, null, "&", \PHP_QUERY_RFC3986);
    }
}