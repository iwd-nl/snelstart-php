<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Model\Grootboek;
use SnelstartPHP\Model\RgsCode;
use SnelstartPHP\Model\Type\Grootboekfunctie;
use SnelstartPHP\Model\Type\Rekeningcode;

final class GrootboekMapper extends AbstractMapper
{
    public static function find(ResponseInterface $response): ?Grootboek
    {
        $mapper = new static($response);
        return $mapper->mapResultToGrootboekModel(new Grootboek(), $mapper->responseData);
    }

    public static function findAll(ResponseInterface $response): \Generator
    {
        return (new static($response))->mapManyResultsToSubMappers();
    }

    public function mapResultToGrootboekModel(Grootboek $grootboek, array $data = []): Grootboek
    {
        $data = empty($data) ? $this->responseData : $data;
        /**
         * @var Grootboek $grootboek
         */
        $grootboek = $this->mapArrayDataToModel($grootboek, $data);

        if (isset($data["rekeningCode"])) {
            $grootboek->setRekeningCode(new Rekeningcode($data["rekeningCode"]));
        }

        if (isset($data["grootboekfunctie"])) {
            $grootboek->setGrootboekfunctie(new Grootboekfunctie($data["grootboekfunctie"]));
        }

        $rgsCodes = \array_map(function(array $rgsCode) {
            return new RgsCode($rgsCode["versie"], $rgsCode["rgsCode"]);
        }, $data["rgsCode"] ?? []);

        return $grootboek->setRgsCode($rgsCodes);
    }

    protected function mapManyResultsToSubMappers()
    {
        foreach ($this->responseData as $grootboekData) {
            yield $this->mapResultToGrootboekModel(new Grootboek(), $grootboekData);
        }
    }
}