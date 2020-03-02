<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Mapper\V2;

use function \array_map;
use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\V2 as Model;
use SnelstartPHP\Model\Type\Grootboekfunctie;
use SnelstartPHP\Model\Type\Rekeningcode;

final class GrootboekMapper extends AbstractMapper
{
    public function find(ResponseInterface $response): Model\Grootboek
    {
        $this->setResponseData($response);
        return $this->mapResultToGrootboekModel(new Model\Grootboek());
    }

    public function findAll(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);
        return $this->mapManyResultsToSubMappers();
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

        if (isset($data["rgsCode"])) {
            $grootboek->setRgsCode(... \array_map(static function(array $rgsCode) {
                return new Model\RgsCode($rgsCode["versie"], $rgsCode["rgsCode"]);
            }, $data["rgsCode"]));
        }

        return $grootboek;
    }

    protected function mapManyResultsToSubMappers(): \Generator
    {
        foreach ($this->responseData as $grootboekData) {
            yield $this->mapResultToGrootboekModel(new Model\Grootboek(), $grootboekData);
        }
    }
}