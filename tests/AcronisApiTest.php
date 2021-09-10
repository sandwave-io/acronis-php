<?php

<<<<<<< HEAD
declare(strict_types=1);
=======
declare(strict_types = 1);
>>>>>>> d87781798975b938cd701245b3e7e5edb382a8e3

namespace SandwaveIo\Acronis\Tests;

use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;
use SandwaveIo\Acronis\AcronisApi;
use SandwaveIo\Acronis\Client\RestClient;
use SandwaveIo\Acronis\Client\TenantClient;
<<<<<<< HEAD
use SandwaveIo\Acronis\Client\UserClient;
use SandwaveIo\Acronis\Client\UsageClient;
=======
>>>>>>> d87781798975b938cd701245b3e7e5edb382a8e3
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
<<<<<<< HEAD
        $this->assertInstanceOf(
            TenantClient::class,
            $acronisApi->getTenantClient(),
            'The Tenants Client could not be instantiated.'
        );
        $this->assertInstanceOf(
            UserClient::class,
            $acronisApi->getUserClient(),
            'The User Client could not be instantiated.'
        );
        $this->assertInstanceOf(
            UsageClient::class,
            $acronisApi->getUsageClient(),
            'The Usage Client could not be instantiated.'
        );
=======
        $this->assertInstanceOf(TenantClient::class, $acronisApi->getTenantClient(), 'The Tenants Client could not be instantiated.');
>>>>>>> d87781798975b938cd701245b3e7e5edb382a8e3
    }
}
