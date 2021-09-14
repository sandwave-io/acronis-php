<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Client;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SandwaveIo\Acronis\Client\RestClientInterface;
use SandwaveIo\Acronis\Client\TenantClient;
use SandwaveIo\Acronis\Entity\Tenant;
use SandwaveIo\Acronis\Exception\AcronisException;

class TenantClientTest extends TestCase
{
    /**
     * @var MockObject|RestClientInterface
     */
    private $restClient;

    /**
     * @var TenantClient
     */
    private $tenantClient;

    protected function setUp(): void
    {
        $this->restClient = $this->createMock(RestClientInterface::class);
        $this->tenantClient = new TenantClient($this->restClient);
    }

    public function testDelete(): void
    {
        $tenantMock = $this->createMock(Tenant::class);
        $tenantMock->setId('numero-1');
        $tenantMock->setVersion(2);

        $this->restClient
            ->expects(self::once())
            ->method('delete')
            ->with(
                $this->equalTo(
                    sprintf('tenants/%s?version=%d', $tenantMock->getId(), $tenantMock->getVersion())
                )
            );

        $this->tenantClient->delete(
            $tenantMock
        );
    }

    public function testDeleteFailure(): void
    {
        $this->restClient
            ->expects(self::once())
            ->method('delete')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->tenantClient->delete($this->createMock(Tenant::class));
    }
}
