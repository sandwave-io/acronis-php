<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests;

use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;
use SandwaveIo\Acronis\AcronisApi;
use SandwaveIo\Acronis\Client\RestClient;
use SandwaveIo\Acronis\Client\TenantClient;
use SandwaveIo\Acronis\RestClientFactory;

class AcronisApiTest extends TestCase
{
    public function test__construct(): void
    {
        $restClientFactory = new RestClientFactory(
            'https://example.com',
            'test-client',
            'my-secret'
        );
        $serializer = $this->createMock(SerializerInterface::class);
        $restClient = new RestClient($restClientFactory->create(), $serializer);
        $acronisApi = new AcronisApi($restClient);

        $this->assertInstanceOf(AcronisApi::class, $acronisApi, 'The Acronis API could not be instantiated.');
        $this->assertInstanceOf(TenantClient::class, $acronisApi->getTenantClient(), 'The Tenants Client could not be instantiated.');
    }
}
