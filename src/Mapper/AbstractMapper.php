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

    /**
     * @deprecated This will be deprecated starting from April 1st 2020
     */
    public function __construct(?ResponseInterface $response = null)
    {
        if ($response !== null) {
            @trigger_error("This will be deprecated starting from April 1st 2020", \E_USER_DEPRECATED);
            return static::fromResponse($response);
        }
    }

    /**
     * Map the array data to the given class.
     *
     * @template T of SnelstartObject
     * @psalm-param T $class
     * @psalm-return T
     */
    protected function mapArrayDataToModel(SnelstartObject $class, array $data = []): SnelstartObject
    {
        foreach ((empty($data) ? $this->responseData : $data) as $key => $value) {
            $class = $this->setDataToModel($class, $key, $value);
        }

        return $class;
    }

    protected function getMoney(string $money): Money
    {
        return new Money(intval(floatval($money) * 100), Snelstart::getCurrency());
    }

    /**
     * @template T of SnelstartObject
     * @psalm-param T $class
     * @psalm-return T
     */
    protected function setDataToModel(SnelstartObject $class, string $key, $value): SnelstartObject
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
            if (method_exists($class, $methodName)) {
                // We only do scalar values. Complex values can be handled in Mapper classes.
                if (is_scalar($value) || is_null($value) || $customSet) {
                    $class->{$methodName}($value);
                }
            }
        } catch (\TypeError $e) {

        }

        return $class;
    }

    protected function setResponseData(ResponseInterface $response): self
    {
        $this->responseData = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);

        // Always make sure that we are dealing with arrays even when the response is empty (201 created for example).
        if ($this->responseData === null) {
            $this->responseData = [];
        }

        return $this;
    }

    protected static function fromResponse(ResponseInterface $response): self
    {
        return (new static())->setResponseData($response);
    }
}