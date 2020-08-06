<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 * @deprecated
 */

namespace SnelstartPHP\Mapper\V1;

use function array_map;
use Money\Currency;
use Money\Money;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\EmailVersturen;
use SnelstartPHP\Model\Land;
use SnelstartPHP\Model\Adres;
use SnelstartPHP\Model\Type as Type;
use SnelstartPHP\Model\V1 as Model;
use SnelstartPHP\Snelstart;

/**
 * @deprecated
 */
final class RelatieMapper extends AbstractMapper
{
    public static function find(ResponseInterface $response): ?Model\Relatie
    {
        return self::fromResponse($response)->mapResponseToRelatieModel(new Model\Relatie());
    }

    public static function findAll(ResponseInterface $response): \Generator
    {
        return self::fromResponse($response)->mapManyResultsToSubMappers();
    }

    public static function add(ResponseInterface $response): Model\Relatie
    {
        return self::fromResponse($response)->mapResponseToRelatieModel(new Model\Relatie());
    }

    public static function update(ResponseInterface $response): Model\Relatie
    {
        return self::fromResponse($response)->mapResponseToRelatieModel(new Model\Relatie());
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

        $relatie->setRelatiesoort(array_map(function(string $relatiesoort) {
            return new Type\Relatiesoort($relatiesoort);
        }, $data["relatiesoort"]));

        if (!empty($data["incassoSoort"])) {
            $relatie->setIncassoSoort(new Type\Incassosoort($data["incassoSoort"]));
        }

        if (!empty($data["aanmaningSoort"])) {
            $relatie->setAanmaningsoort(new Type\Aanmaningsoort($data["aanmaningSoort"]));
        }

        if ($data["kredietLimiet"] !== null) {
            $relatie->setKredietLimiet($this->getMoney($data["kredietLimiet"]));
        }

        if ($data["factuurkorting"] !== null) {
            $relatie->setFactuurkorting($this->getMoney($data["factuurkorting"]));
        }

        if (!empty($data["vestigingsAdres"])) {
            $relatie->setVestigingsAdres($this->mapAddressToRelatieAddress($data["vestigingsAdres"]));
        }

        if (!empty($data["correspondentieAdres"])) {
            $relatie->setCorrespondentieAdres($this->mapAddressToRelatieAddress($data["correspondentieAdres"]));
        }

        $relatie->setOfferteEmailVersturen($this->mapEmailVersturenField($data["offerteEmailVersturen"]))
                ->setBevestigingsEmailVersturen($this->mapEmailVersturenField($data["offerteEmailVersturen"]))
                ->setFactuurEmailVersturen($this->mapEmailVersturenField($data["factuurEmailVersturen"]))
                ->setAanmaningEmailVersturen($this->mapEmailVersturenField($data["aanmaningEmailVersturen"]));

        return $relatie;
    }

    /**
     * Map the response data to the model.
     */
    public function mapAddressToRelatieAddress(array $address): Adres
    {
        return (new Adres())
            ->setContactpersoon($address["contactpersoon"])
            ->setStraat($address["straat"])
            ->setPostcode($address["postcode"])
            ->setPlaats($address["plaats"])
            ->setLand(Land::createFromUUID(Uuid::fromString($address["land"]["id"])));
    }

    /**
     * Map all data to the EmailVersturen class (added support for subtypes).
     *
     * @param array  $emailVersturen
     * @param string $emailVersturenClass
     * @return EmailVersturen
     */
    public function mapEmailVersturenField(array $emailVersturen, string $emailVersturenClass = EmailVersturen::class): EmailVersturen
    {
        return new $emailVersturenClass(
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