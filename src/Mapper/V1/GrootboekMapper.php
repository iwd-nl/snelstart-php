<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Mapper\V1;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\V1 as Model;
use SnelstartPHP\Model\Type\Grootboekfunctie;
use SnelstartPHP\Model\Type\Rekeningcode;

/**
 * @deprecated
 */
final class GrootboekMapper extends AbstractMapper
{
    public static function find(ResponseInterface $response): ?Model\Grootboek
    {
        return self::fromResponse($response)->mapResultToGrootboekModel(new Model\Grootboek());
    }

    public static function findAll(ResponseInterface $response): \Generator
    {
        return self::fromResponse($response)->mapManyResultsToSubMappers();
    }

    protected function mapResultToGrootboekModel(Model\Grootboek $grootboek, array $data = []): Model\Grootboek
    {
        $data = empty($data) ? $this->responseData : $data;
        /**
         * @var Model\Grootboek $grootboek
         */
        $grootboek = $this->mapArrayDataToModel($grootboek, $data);

        if (isset($data["rekeningCode"])) {
            $grootboek->setRekeningCode(new Rekeningcode($data["rekeningCode"]));
        }

        if (isset($data["grootboekfunctie"])) {
            $grootboek->setGrootboekfunctie(new Grootboekfunctie($data["grootboekfunctie"]));
        }

        return $grootboek->setRgsCode(\array_map(static function(array $rgsCode) {
            return new Model\RgsCode($rgsCode["versie"], $rgsCode["rgsCode"]);
        }, $data["rgsCode"] ?? []));
    }

    protected function mapManyResultsToSubMappers(): \Generator
    {
        foreach ($this->responseData as $grootboekData) {
            yield $this->mapResultToGrootboekModel(new Model\Grootboek(), $grootboekData);
        }
    }
}