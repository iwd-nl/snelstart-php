<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V1;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\V1 as Model;
use SnelstartPHP\Model\Type\Grootboekfunctie;
use SnelstartPHP\Model\Type\Rekeningcode;

final class GrootboekMapper extends AbstractMapper
{
    public static function find(ResponseInterface $response): ?Model\Grootboek
    {
        $mapper = new static($response);
        return $mapper->mapResultToGrootboekModel(new Model\Grootboek(), $mapper->responseData);
    }

    public static function findAll(ResponseInterface $response): \Generator
    {
        return (new static($response))->mapManyResultsToSubMappers();
    }

    public function mapResultToGrootboekModel(Model\Grootboek $grootboek, array $data = []): Model\Grootboek
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

        $rgsCodes = \array_map(function(array $rgsCode) {
            return new Model\RgsCode($rgsCode["versie"], $rgsCode["rgsCode"]);
        }, $data["rgsCode"] ?? []);

        return $grootboek->setRgsCode($rgsCodes);
    }

    protected function mapManyResultsToSubMappers()
    {
        foreach ($this->responseData as $grootboekData) {
            yield $this->mapResultToGrootboekModel(new Model\Grootboek(), $grootboekData);
        }
    }
}