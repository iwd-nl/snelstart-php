<?php
declare(strict_types=1);

namespace SnelstartPHP\Mapper\V2\Relatie;

use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Mapper\AbstractMapper;
use SnelstartPHP\Model\V2\Relatie;
use SnelstartPHP\Model\V2\Relatie\DoorlopendeIncassoMachtiging;

final class DoorlopendeIncassoMachtigingMapper extends AbstractMapper
{
    public function findByRelatie(ResponseInterface $response): \Generator
    {
        $this->setResponseData($response);

        foreach ($this->responseData as $doorlopendeIncassoMachtiging) {
            yield $this->mapResultToDoorlopendeIncassoMachtiging(new DoorlopendeIncassoMachtiging(), $doorlopendeIncassoMachtiging);
        }
    }

    private function mapResultToDoorlopendeIncassoMachtiging(DoorlopendeIncassoMachtiging $doorlopendeIncassoMachtiging, array $data = []): DoorlopendeIncassoMachtiging
    {
        $data = empty($data) ? $this->responseData : $data;
        /** @var DoorlopendeIncassoMachtiging $object */
        $object = $this->mapArrayDataToModel($doorlopendeIncassoMachtiging, $data);

        if (isset($data["afsluitDatum"])) {
            try {
                $object->setAfsluitDatum(new \DateTimeImmutable($data["afsluitDatum"]));
            } catch (\Exception $e) {
                // This is caused by an invalid date format.
            }
        }

        if (isset($data["intrekkingsDatum"])) {
            try {
                $object->setIntrekkingsDatum(new \DateTimeImmutable($data["intrekkingsDatum"]));
            } catch (\Exception $e) {
                // This is caused by an invalid date format.
            }
        }

        if (isset($data["klant"])) {
            $object->setKlant(Relatie::createFromUUID(Uuid::fromString($data["klant"]["id"])));
        }

        return $object;
    }
}