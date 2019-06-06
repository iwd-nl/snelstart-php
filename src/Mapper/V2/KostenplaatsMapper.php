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
    public static function find(ResponseInterface $response): ?Kostenplaats
    {
        return static::mapSimpleResponse($response);
    }

    public static function findAll(ResponseInterface $response): \Generator
    {
        $mapper = new static($response);

        foreach ($mapper->responseData as $kostenplaats) {
            yield $mapper->mapArrayDataToModel(new Kostenplaats(), $kostenplaats);
        }
    }

    public static function add(ResponseInterface $response): Kostenplaats
    {
        return static::mapSimpleResponse($response);
    }

    public static function update(ResponseInterface $response): Kostenplaats
    {
        return static::mapSimpleResponse($response);
    }

    public static function delete(ResponseInterface $response): void
    {
        return;
    }

    private static function mapSimpleResponse(ResponseInterface $response): ?Kostenplaats
    {
        $mapper = new static($response);
        return $mapper->mapArrayDataToModel(new Kostenplaats(), $mapper->responseData);
    }
}