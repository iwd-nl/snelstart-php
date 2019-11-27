<?php declare(strict_types=1);

namespace SnelstartPHP\Tests\Request\V2;

use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use SnelstartPHP\Exception\PreValidationException;
use SnelstartPHP\Model\Type\DocumentType;
use SnelstartPHP\Model\V2\Document;
use SnelstartPHP\Model\V2\Inkoopboeking;
use SnelstartPHP\Model\V2\Relatie;
use SnelstartPHP\Model\V2\Verkoopboeking;
use SnelstartPHP\Request\V2\DocumentRequest;

class DocumentRequestTest extends TestCase
{
    public function testFind()
    {
        $uuid = Uuid::uuid4();
        $expected = new Request("GET", "documenten/" . $uuid->toString());

        $this->assertEquals($expected, DocumentRequest::find($uuid));
    }

    public function testFindByDocumentTypeAndParentIdentifier()
    {
        $uuid = Uuid::uuid4();

        foreach (DocumentType::toArray() as $key => $value) {
            $documentType = new DocumentType($value);
            $expectedRequest = new Request("GET", "documenten/" . $documentType->getValue() . "/" . $uuid->toString());

            $this->assertEquals($expectedRequest, DocumentRequest::findByDocumentTypeAndParentIdentifier($documentType, $uuid));
        }
    }

    public function testAddBoekingDocumentButNoIdPresent()
    {
        $document = new Document();
        $methods = [
            "addVerkoopBoekingDocument" =>  new Verkoopboeking(),
            "addInkoopBoekingDocument"  =>  new Inkoopboeking(),
            "addRelatieDocument"        =>  new Relatie(),
            "updateDocument"            =>  null,
            "deleteDocument"            =>  null,
        ];

        foreach ($methods as $method => $argument) {
            $this->expectException(PreValidationException::class);
            call_user_func([ DocumentRequest::class, $method ], $document, $argument);
        }
    }

    public function testAddInkoopBoekingDocument()
    {
        $uuid = Uuid::uuid4();

        $document = new Document();
        $document->setParentIdentifier($uuid);
        $inkoopboeking = Inkoopboeking::createFromUUID($uuid);

        $expected = new Request("POST", "documenten/Inkoopboekingen", [
            "Content-Type"  =>  "application/json",
        ], json_encode([
            "parentIdentifier"  =>  $uuid->toString(),
            "content"           =>  null,
            "fileName"          =>  null,
        ]));

        $request = DocumentRequest::addInkoopBoekingDocument($document, $inkoopboeking);

        $this->assertEquals($expected->getUri(), $request->getUri());
        $this->assertJsonStringEqualsJsonString($expected->getBody()->getContents(), $request->getBody()->getContents());
    }

    public function testAddVerkoopBoekingDocument()
    {
        $uuid = Uuid::uuid4();

        $document = new Document();
        $document->setParentIdentifier($uuid);
        $verkoopboeking = Verkoopboeking::createFromUUID($uuid);

        $expected = new Request("POST", "documenten/Verkoopboekingen", [
            "Content-Type"  =>  "application/json",
        ], json_encode([
            "parentIdentifier"  =>  $uuid->toString(),
            "content"           =>  null,
            "fileName"          =>  null,
        ]));

        $request = DocumentRequest::addVerkoopBoekingDocument($document, $verkoopboeking);

        $this->assertEquals($expected->getUri(), $request->getUri());
        $this->assertJsonStringEqualsJsonString($expected->getBody()->getContents(), $request->getBody()->getContents());
    }

    public function testAddRelatieDocument()
    {
        $uuid = Uuid::uuid4();

        $document = new Document();
        $document->setParentIdentifier($uuid);
        $relatie = Relatie::createFromUUID($uuid);

        $expected = new Request("POST", "documenten/Relaties", [
            "Content-Type"  =>  "application/json",
        ], json_encode([
            "parentIdentifier"  =>  $uuid->toString(),
            "content"           =>  null,
            "fileName"          =>  null,
        ]));

        $request = DocumentRequest::addRelatieDocument($document, $relatie);

        $this->assertEquals($expected->getUri(), $request->getUri());
        $this->assertJsonStringEqualsJsonString($expected->getBody()->getContents(), $request->getBody()->getContents());
    }

    public function testUpdateDocument()
    {
        $id = Uuid::uuid4();
        $document = (new Document())->setId($id);
        $expected = new Request("POST", "documenten/" . $document->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ], json_encode([
            "id"                =>  $id->toString(),
            "parentIdentifier"  =>  null,
            "content"           =>  null,
            "fileName"          =>  null,
        ]));
        $request = DocumentRequest::updateDocument($document);

        $this->assertEquals($expected->getUri(), $request->getUri());
        $this->assertJsonStringEqualsJsonString($expected->getBody()->getContents(), $request->getBody()->getContents());
    }

    public function testDeleteDocument()
    {
        $id = Uuid::uuid4();
        $document = (new Document())->setId($id);
        $expected = new Request("DELETE", "documenten/" . $document->getId()->toString(), [
            "Content-Type"  =>  "application/json"
        ]);
        $request = DocumentRequest::deleteDocument($document);

        $this->assertEquals($expected->getUri(), $request->getUri());
        $this->assertEmpty($request->getBody()->getContents());
    }
}
