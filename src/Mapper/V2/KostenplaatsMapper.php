<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\Kostenplaats;

final class KostenplaatsMapper extends AbstractMapper
{
    public function find(ResponseInterface $response): ?Kostenplaats
    {
        return $this->mapSimpleResponse($response);
    }

    public function findAll(ResponseInterface $response): \Generator
    {
        foreach ($this->setResponseData($response)->responseData as $kostenplaats) {
            yield $this->mapArrayDataToModel(new Kostenplaats(), $kostenplaats);
        }
    }

    public function add(ResponseInterface $response): Kostenplaats
    {
        return $this->mapSimpleResponse($response);
    }

    public function update(ResponseInterface $response): Kostenplaats
    {
        return $this->mapSimpleResponse($response);
    }

    public function delete(ResponseInterface $response): void
    {
        return;
    }

    private function mapSimpleResponse(ResponseInterface $response): Kostenplaats
    {
        $this->setResponseData($response);
        return $this->mapArrayDataToModel(new Kostenplaats());
    }
}