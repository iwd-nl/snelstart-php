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

    public function getFilter(): array
    {
        return $this->filter;
    }

    public function setFilter(array $filter): self
    {
        $this->filter = $filter;

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
            $collection['$filter'] = implode(" and ", $this->getFilter());
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

        return http_build_query($collection);
    }
}