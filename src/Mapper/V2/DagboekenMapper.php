<?php

namespace SnelstartPHP\Mapper\V2;

use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Model\Type;

final class DagboekenMapper extends AbstractMapper
{
    public function findAll(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);

        foreach ($this->responseData as $data) {
            yield $this->mapResultToModel($data);
        }
    }

    protected function mapResultToModel($data): Model\Dagboek
    {
        return (new Model\Dagboek())
            ->setId(Uuid::fromString($data["id"]))
            ->setUri($data['uri'])
            ->setSoort(new Type\DagboekSoort($data["soort"]))
            ->setNummer($data['nummer'])
            ->setOmschrijving($data["omschrijving"])
            ->setNonactief($data["nonactief"])
            ;
    }
}
