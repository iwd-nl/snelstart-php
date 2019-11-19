<?php
/**
 * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
 * @project SnelstartApiPHP
 */

namespace SnelstartPHP\Mapper;

use Money\Money;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Snelstart;

abstract class AbstractMapper
{
    /**
     * @var array
     */
    protected $responseData = [];

    public function __construct(ResponseInterface $response)
    {
        $this->responseData = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Map the array data to the given class.
     */
    protected function mapArrayDataToModel(SnelstartObject $class, array $data = []): SnelstartObject
    {
        foreach ((empty($data) ? $this->responseData : $data) as $key => $value) {
            $class = static::setDataToModel($class, $key, $value);
        }

        return $class;
    }

    protected function getMoney(string $money): Money
    {
        return new Money(intval($money) * 100, Snelstart::getCurrency());
    }

    protected static function setDataToModel(SnelstartObject $class, string $key, $value): SnelstartObject
    {
        $methodName = "set" . ucfirst($key);
        $customSet = false;

        if ($key === "id" && is_string($value)) {
            $value = Uuid::fromString($value);
            $customSet = true;
        } else if (substr($key, -2, 2) === "On" || strpos($key, "datum") !== false) {
            $value = \DateTimeImmutable::createFromFormat(Snelstart::DATETIME_FORMAT, $value);

            if (!$value) {
                $value = null;
            }

            $customSet = true;
        }

        try {
            if (is_object($class) && method_exists($class, $methodName)) {
                // We only do scalar values. Complex values can be handled in Mapper classes.
                if (is_scalar($value) || is_null($value) || $customSet) {
                    $class->{$methodName}($value);
                }
            }
        } catch (\TypeError $e) {

        }

        return $class;
    }
}