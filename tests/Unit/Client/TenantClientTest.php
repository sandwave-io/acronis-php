<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Unit\Client;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SandwaveIo\Acronis\Client\RestClientInterface;
use SandwaveIo\Acronis\Client\TenantClient;
use SandwaveIo\Acronis\Entity\Tenant;

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

    /**
     * @var Tenant
     */
    private $tenant;

    protected function setUp(): void
    {
        $this->restClient = $this->createMock(RestClientInterface::class);
        $this->tenantClient = new TenantClient($this->restClient);
        $this->tenant = new Tenant(
            'parent-uid',
            'Test tenant',
            'customer'
        );
    }

    public function testDelete(): void
    {
        $tenantUid = 'f313ecf6-9256-4afd-9d47-72e032ee81d0';
        $this->tenant->setId($tenantUid)
            ->setVersion(2);

        $this->restClient
            ->expects(self::once())
            ->method('delete');

        $this->tenantClient->delete(
            $this->tenant
        );
    }
}
