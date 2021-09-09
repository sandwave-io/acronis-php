<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Client;

use DateTimeImmutable;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use SandwaveIo\Acronis\Client\RestClient;
use SandwaveIo\Acronis\Entity\Contact;
use SandwaveIo\Acronis\Entity\Tenant;

class RestClientTest extends TestCase
{
    /**
     * @var RestClient
     */
    private $restClient;

    /**
     * @var ClientInterface|MockObject
     */
    private $client;

    protected function setUp(): void
    {
        $serializerBuilder = new SerializerBuilder();
        $this->client = $this->createMock(ClientInterface::class);
        $this->restClient = new RestClient($this->client, $serializerBuilder->build());
    }

    public function test__construct(): void
    {
        $this->assertInstanceOf(RestClient::class, $this->restClient, 'The Rest client could not be instantiated.');
    }

    public function testGetEntity(): void
    {
        /** @var DateTimeImmutable $createdAt */
        $createdAt = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2000-01-01 00:00:00');
        /** @var DateTimeImmutable $updatedAt */
        $updatedAt = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2000-01-01 00:00:01');
        $expectedTenant = new Tenant(
            1,
            '2222-1234-4321-1234',
            '3333-1234-4321-1234',
            2,
            '4444-1234-4321-1234',
            'Tenant name',
            'no-tag',
            'customerType',
            'status',
            'kind',
            'default',
            'en',
            true,
            true,
            false,
            $createdAt,
            $updatedAt,
            new Contact(),
            '1111-1234-4321-1234',
        );

        $stream = $this->createMock(StreamInterface::class);
        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('{"id":"1111-1234-4321-1234","parent_id":"2222-1234-4321-1234","owner_id":null,"brand_uuid":"3333-1234-4321-1234","brand_id":2,"customer_id":"4444-1234-4321-1234","version":1,"name":"Tenant name","internal_tag":"no-tag","customer_type":"customerType","mfa_status":"status","kind":"kind","pricing_mode":"default","language":"en","enabled":true,"has_children":true,"ancestral_access":false,"created_at":"2000-01-01T00:00:00","updated_at":"2000-01-01T00:00:01","deleted_at":null,"contact":{}}');

        $response = $this->createMock(ResponseInterface::class);
        $response->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $this->client->expects($this->once())
            ->method('request')
            ->willReturn($response);

        $tenant = $this->restClient->getEntity('test', Tenant::class);
        $this->assertInstanceOf(Tenant::class, $tenant, 'Data could not be deserialized to entity.');
        $this->assertEquals($expectedTenant, $tenant);
    }
}
