<?php

declare(strict_types=1);

namespace SandwaveIo\Acronis\Tests\Client;

use GuzzleHttp\ClientInterface;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SandwaveIo\Acronis\Client\RestClient;
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
        $serialzerBuilder = new SerializerBuilder();
        $this->client = $this->createMock(ClientInterface::class);
        $this->restClient = new RestClient($this->client, $serialzerBuilder->build());
    }

    public function test__construct(): void
    {
        $this->assertInstanceOf(RestClient::class, $this->restClient, 'The Rest client could not be instantiated.');
    }

    public function testGetEntity(): void
    {
//        $tenant = $this->restClient->getEntity('test', Tenant::class);
    }
}
