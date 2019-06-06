<?php
/**
 * @author  OptiWise Technologies B.V. <info@optiwise.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper\V2;

use Ramsey\Uuid\Uuid;
use SnelstartPHP\Model\Adres;
use SnelstartPHP\Model\Land;

final class AdresMapper
{
    public static function mapAdresToSnelstartObject(array $data): Adres
    {
        return (new Adres())
            ->setContactpersoon($data["contactpersoon"])
            ->setStraat($data["straat"])
            ->setPostcode($data["postcode"])
            ->setPlaats($data["plaats"])
            ->setLand(Land::createFromUUID(Uuid::fromString($data["land"]["id"])));
    }
}