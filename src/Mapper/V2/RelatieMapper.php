<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use Psr\Http\Message\ResponseInterface;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\EmailVersturen;
use SnelstartPHP\Model\Type as Type;
use SnelstartPHP\Model\V2 as Model;

final class RelatieMapper extends AbstractMapper
{
    public static function find(ResponseInterface $response): ?Model\Relatie
    {
        $mapper = new static($response);
        return $mapper->mapResponseToRelatieModel(new Model\Relatie(), $mapper->responseData);
    }

    public static function findAll(ResponseInterface $response): \Generator
    {
        return (new static($response))->mapManyResultsToSubMappers();
    }

    public static function add(ResponseInterface $response): Model\Relatie
    {
        $mapper = new static($response);
        return $mapper->mapResponseToRelatieModel(new Model\Relatie(), $mapper->responseData);
    }

    public static function update(ResponseInterface $response): Model\Relatie
    {
        $mapper = new static($response);
        return $mapper->mapResponseToRelatieModel(new Model\Relatie(), $mapper->responseData);
    }

    /**
     * Map the data from the response to the model.
     */
    public function mapResponseToRelatieModel(Model\Relatie $relatie, array $data = []): Model\Relatie
    {
        $data = empty($data) ? $this->responseData : $data;
        /**
         * @var Model\Relatie $relatie
         */
        $relatie = $this->mapArrayDataToModel($relatie, $data);

        $relatie->setRelatiesoort(\array_map(function(string $relatiesoort) {
            return new Type\Relatiesoort($relatiesoort);
        }, $data["relatiesoort"]));

        if (!empty($data["incassoSoort"])) {
            $relatie->setIncassoSoort(new Type\Incassosoort($data["incassoSoort"]));
        }

        if (!empty($data["aanmaningSoort"])) {
            $relatie->setAanmingsoort(new Type\Aanmaningsoort($data["aanmaningSoort"]));
        }

        if ($data["kredietLimiet"] !== null) {
            $relatie->setKredietLimiet($this->getMoney($data["kredietLimiet"]));
        }

        if ($data["factuurkorting"] !== null) {
            $relatie->setFactuurkorting($this->getMoney($data["factuurkorting"]));
        }

        if (!empty($data["vestigingsAdres"])) {
            $relatie->setVestigingsAdres(AdresMapper::mapAdresToSnelstartObject($data["vestigingsAdres"]));
        }

        if (!empty($data["correspondentieAdres"])) {
            $relatie->setCorrespondentieAdres(AdresMapper::mapAdresToSnelstartObject($data["correspondentieAdres"]));
        }

        $relatie->setOfferteEmailVersturen(static::mapEmailVersturenField($data["offerteEmailVersturen"]))
                ->setBevestigingsEmailVersturen(static::mapEmailVersturenField($data["offerteEmailVersturen"]))
                ->setFactuurEmailVersturen(static::mapEmailVersturenField($data["factuurEmailVersturen"]))
                ->setAanmaningEmailVersturen(static::mapEmailVersturenField($data["aanmaningEmailVersturen"]));

        return $relatie;
    }

    /**
     * Map all data to the EmailVersturen class (added support for subtypes).
     *
     * @param array  $emailVersturen
     * @return EmailVersturen
     */
    public function mapEmailVersturenField(array $emailVersturen): EmailVersturen
    {
        return new EmailVersturen(
            $emailVersturen["shouldSend"],
            $emailVersturen["email"],
            $emailVersturen["ccEmail"]
        );
    }

    /**
     * Map many results to the mapper.
     *
     * @return \Generator
     */
    protected function mapManyResultsToSubMappers(): \Generator
    {
        foreach ($this->responseData as $relatieData) {
            yield $this->mapResponseToRelatieModel(new Model\Relatie(), $relatieData);
        }
    }
}