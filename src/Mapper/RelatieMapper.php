<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper;

use function array_map;
use Money\Currency;
use Money\Money;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Model\EmailVersturen;
use SnelstartPHP\Model\Relatie;
use SnelstartPHP\Model\RelatieAdres;
use SnelstartPHP\Model\RelatieCorrespondentieAdres;
use SnelstartPHP\Model\RelatieVestigingsAdres;
use SnelstartPHP\Model\Type\Aanmaningsoort;
use SnelstartPHP\Model\Type\Incassosoort;
use SnelstartPHP\Model\Type\Relatiesoort;
use SnelstartPHP\Snelstart;

class RelatieMapper extends AbstractMapper
{
    public static function find(ResponseInterface $response): ?Relatie
    {
        $mapper = new static($response);
        return $mapper->mapResponseToRelatieModel(new Relatie(), $mapper->responseData);
    }

    public static function findAll(ResponseInterface $response): \Generator
    {
        return (new static($response))->mapManyResultsToSubMappers();
    }

    /**
     * Map many results to the mapper.
     *
     * @return \Generator
     */
    protected function mapManyResultsToSubMappers(): \Generator
    {
        foreach ($this->responseData as $relatieData) {
            yield $this->mapResponseToRelatieModel(new Relatie(), $relatieData);
        }
    }

    /**
     * Map the data from the response to the model.
     */
    protected function mapResponseToRelatieModel(Relatie $relatie, array $data = []): Relatie
    {
        $data = empty($data) ? $this->responseData : $data;
        $relatie = $this->mapArrayDataToModel($relatie, $data);
        $currency = new Currency(Snelstart::CURRENCY);

        $relatie->setRelatiesoort(array_map(function(string $relatiesoort) {
            return new Relatiesoort($relatiesoort);
        }, $data["relatiesoort"]));

        if (!empty($data["incassoSoort"])) {
            $relatie->setIncassoSoort(new Incassosoort($data["incassoSoort"]));
        }

        if (!empty($data["aanmaningSoort"])) {
            $relatie->setAanmingsoort(new Aanmaningsoort($data["aanmaningSoort"]));
        }

        if ($data["kredietLimiet"] !== null) {
            $relatie->setKredietLimiet(new Money($data["kredietLimiet"], $currency));
        }

        if ($data["factuurkorting"] !== null) {
            $relatie->setFactuurkorting(new Money($data["factuurkorting"], $currency));
        }

        if (!empty($data["vestigingsAdres"])) {
            $relatie->setVestigingsAdres(static::mapAddressToRelatieAddress($data["vestigingsAdres"], RelatieVestigingsAdres::class));
        }

        if (!empty($data["correspondentieAdres"])) {
            $relatie->setCorrespondentieAdres(static::mapAddressToRelatieAddress($data["correspondentieAdres"], RelatieCorrespondentieAdres::class));
        }

        $relatie->setOfferteEmailVersturen(static::mapEmailVersturenField($data["offerteEmailVersturen"]))
                ->setBevestigingsEmailVersturen(static::mapEmailVersturenField($data["offerteEmailVersturen"]))
                ->setFactuurEmailVersturen(static::mapEmailVersturenField($data["factuurEmailVersturen"]))
                ->setAanmaningEmailVersturen(static::mapEmailVersturenField($data["aanmaningEmailVersturen"]));

        return $relatie;
    }

    /**
     * Map the response data to the model. Should extend the RelatieAdres class.
     *
     * @param array  $address
     * @param string $addressClass
     * @return RelatieAdres
     */
    protected function mapAddressToRelatieAddress(array $address, string $addressClass): RelatieAdres
    {
        /**
         * @var RelatieAdres $class
         */
        $class = new $addressClass;

        if (!$class instanceof RelatieAdres) {
            throw new \InvalidArgumentException(sprintf("Only classes that extend '%s' are allowed here.", RelatieAdres::class));
        }

        return $class
            ->setContactpersoon($address["contactpersoon"])
            ->setStraat($address["straat"])
            ->setPostcode($address["postcode"])
            ->setPlaats($address["plaats"])
            ->setLand(Uuid::fromString($address["land"]["id"]));
    }

    /**
     * Map all data to the EmailVersturen class (added support for subtypes).
     *
     * @param array  $emailVersturen
     * @param string $emailVersturenClass
     * @return EmailVersturen
     */
    protected function mapEmailVersturenField(array $emailVersturen, string $emailVersturenClass = EmailVersturen::class): EmailVersturen
    {
        return new $emailVersturenClass(
            $emailVersturen["shouldSend"],
            $emailVersturen["email"],
            $emailVersturen["ccEmail"]
        );
    }
}