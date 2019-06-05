<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Mapper\V1;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\Land;

final class LandMapper extends AbstractMapper
{
    public static function find(ResponseInterface $response): ?Land
    {
        $mapper = new static($response);
        return $mapper->mapArrayDataToModel(new Land(), $mapper->responseData);
    }

    public static function findAll(ResponseInterface $response): \Generator
    {
        $mapper = new static($response);

        foreach ($mapper->responseData as $landData) {
            yield $mapper->mapArrayDataToModel(new Land(), $landData);
        }
    }
}