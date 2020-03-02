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

/**
 * @deprecated
 */
final class LandMapper extends AbstractMapper
{
    public static function find(ResponseInterface $response): Land
    {
        return self::fromResponse($response)->mapArrayDataToModel(new Land());
    }

    public static function findAll(ResponseInterface $response): \Generator
    {
        $mapper = self::fromResponse($response);

        foreach ($mapper->responseData as $landData) {
            yield $mapper->mapArrayDataToModel(new Land(), $landData);
        }
    }
}