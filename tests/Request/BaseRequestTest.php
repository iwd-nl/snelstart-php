<?php

namespace SnelstartPHP\Tests\Request;

use Money\Money;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use SnelstartPHP\Model\BaseObject;
use SnelstartPHP\Model\SnelstartObject;
use SnelstartPHP\Serializer\RequestSerializerInterface;
use SnelstartPHP\Tests\stubs\SimpleRequestObjectStub;
use SnelstartPHP\Tests\stubs\SimpleRequestStub;

class BaseRequestTest extends TestCase
{
    private $requestSerializer;

    public function setUp(): void
    {
        $this->requestSerializer = $this->createMock(RequestSerializerInterface::class);
    }

    public function testEditableArgumentsAreEmpty(): void
    {
        $request = new SimpleRequestStub($this->requestSerializer);
        $object = new SimpleRequestObjectStub;

        $this->assertEmpty($object::getEditableAttributes());
        $this->assertEmpty($request->prepareAddOrEditRequestForSerialization($object));
    }

    public function testEditableArgumentsAreNotEmpty(): void
    {
        $object = new SimpleRequestObjectStub;
        $object::$editableAttributes = [ "nullValue" ];

        $this->assertNotEmpty($object::getEditableAttributes());
    }

    public function testEditableArgumentsCallForNotExistingMethod(): void
    {
        $object = new SimpleRequestObjectStub();
        $request = new SimpleRequestStub($this->requestSerializer);

        $object::$editableAttributes = [ "notExistingProperty" ];

        $this->expectNotice();
        $this->assertEmpty($request->prepareAddOrEditRequestForSerialization($object));
    }

    public function testIfSerializationIsCallingAllMethodsDependingOnInput()
    {
        $uuid = Uuid::uuid4();
        $dateTime = new \DateTimeImmutable();
        $money = Money::EUR(1000);
        $array = [
            (new class extends SnelstartObject {})
        ];

        $inputObject = new class($uuid, $money, $dateTime, $array) extends BaseObject {
            private $simpleValue;
            private $id;
            private $dateTime;
            private $money;
            private $array;

            public function __construct(UuidInterface $id, Money $money, \DateTimeInterface $dateTime, array $array)
            {
                $this->id = $id;
                $this->money = $money;
                $this->dateTime = $dateTime;
                $this->array = $array;
                $this->simpleValue = "test";
            }

            public function getSimpleValue()
            {
                return $this->simpleValue;
            }

            public function getId(): UuidInterface
            {
                return $this->id;
            }

            public function getDateTime(): \DateTimeInterface
            {
                return $this->dateTime;
            }

            public function getMoney(): Money
            {
                return $this->money;
            }

            public function getArray(): array
            {
                return $this->array;
            }
        };

        $this->requestSerializer
            ->expects($this->exactly(2))
            ->method("scalarValue")
        ;

        $this->requestSerializer
            ->expects($this->once())
            ->method("uuidInterfaceToString")
        ;

        $this->requestSerializer
            ->expects($this->once())
            ->method("dateTimeToString")
        ;

        $this->requestSerializer
            ->expects($this->once())
            ->method("moneyFormatToString")
        ;

        $this->requestSerializer
            ->expects($this->once())
            ->method("arrayValue")
        ;

        $request = new SimpleRequestStub($this->requestSerializer);
        $request->prepareAddOrEditRequestForSerialization($inputObject, ...[
            "simpleValue", "id", "dateTime", "money", "array"
        ]);
    }

    public function testSimpleValueRequestSerialization(): void
    {
        $request = new SimpleRequestStub();
        $object = new SimpleRequestObjectStub;
        $object::$editableAttributes = [ "simpleValue" ];

        $this->assertNotEmpty($object::getEditableAttributes());
        $this->assertEquals($request->prepareAddOrEditRequestForSerialization($object), [ "simpleValue" => "test" ]);
    }

    public function testNullValueRequestSerialization(): void
    {
        $request = new SimpleRequestStub();
        $object = new SimpleRequestObjectStub;
        $object::$editableAttributes = [ "nullValue" ];

        $this->assertEquals($request->prepareAddOrEditRequestForSerialization($object), [ "nullValue" => null ]);
    }

    public function testIntegerValueRequestSerialization(): void
    {
        $request = new SimpleRequestStub();
        $object = new SimpleRequestObjectStub;
        $object::$editableAttributes = [ "integerValue" ];

        $this->assertEquals($request->prepareAddOrEditRequestForSerialization($object), [ "integerValue" => 1 ]);
    }

    public function testBooleanValueRequestSerialization(): void
    {
        $request = new SimpleRequestStub();
        $object = new SimpleRequestObjectStub;
        $object::$editableAttributes = [ "booleanValue" ];

        $this->assertEquals($request->prepareAddOrEditRequestForSerialization($object), [ "booleanValue" => false ]);
    }
}
