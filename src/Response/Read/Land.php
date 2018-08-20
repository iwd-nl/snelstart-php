<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Response\Read;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Model\Land as LandModel;
use SnelstartPHP\Response\Base;

class Land extends Base
{
    public static function find(ResponseInterface $response): ?LandModel
    {
        return static::mapArrayDataToModel(
            new LandModel(),
            \GuzzleHttp\json_decode($response->getBody(), true)
        );
    }

    public static function findAll(ResponseInterface $response): \Generator
    {
        foreach (\GuzzleHttp\json_decode($response->getBody(), true) as $landModelData) {
            yield static::mapArrayDataToModel(
                new LandModel(),
                $landModelData
            );
        }
    }
}