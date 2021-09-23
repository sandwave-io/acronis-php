<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Unit\Client;

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

    /*
    public function testGet(): void
    {
        $tenantUid = 'numero-1';

        $this->tenant->setId($tenantUid);

        $this->restClient
            ->expects(self::once())
            ->method('getEntity')
            ->with(
                $this->equalTo(
                    sprintf('tenants/%s', $tenantUid)
                )
            )
            ->willReturn($this->tenant);

        $responeTenant = $this->tenantClient->get($tenantUid);

        self::assertSame($tenantUid, $responeTenant->getId());
    }

    public function testGetFailure(): void
    {
        $this->restClient
            ->expects(self::once())
            ->method('getEntity')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->tenantClient->get('numero-1');
    }

    public function testGetChildren(): void
    {
        $tenantUid = 'numero-1';

        $tenantList = [
            $this->tenant->setId($tenantUid),
        ];

        $this->restClient
            ->expects(self::once())
            ->method('getEntityCollection')
            ->with(
                $this->equalTo(
                    sprintf('tenants?parent_id=%s', $tenantUid)
                )
            )
            ->willReturn($tenantList);

        $response = $this->tenantClient->getChildren($tenantUid);

        $this->assertCount(count($tenantList), $response);
        $first = array_shift($response);
        $this->assertInstanceOf(Tenant::class, $first);
        $this->assertSame('Test tenant', $first->getName());
    }

    public function testGetChildrenFailure(): void
    {
        $this->restClient
            ->expects(self::once())
            ->method('getEntityCollection')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->tenantClient->getChildren('numero-1');
    }

    public function testCreate(): void
    {
        $expectedTenant = clone $this->tenant;
        $expectedTenant->setId('new-uid');

        $this->restClient
            ->expects(self::once())
            ->method('post')
            ->with(
                $this->equalTo('tenants')
            )->willReturn($expectedTenant);

        $createdTenant = $this->tenantClient->create($this->tenant);

        self::assertNull($this->tenant->getId());
        self::assertNotNull($createdTenant->getId());
    }

    public function testCreateFailure(): void
    {
        $this->restClient
            ->expects(self::once())
            ->method('post')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->tenantClient->create($this->tenant);
    }

    public function testUpdate(): void
    {
        $tenantUid = 'numero-1';
        $this->tenant->setId($tenantUid)->setEnabled(true);

        $this->restClient
            ->expects(self::once())
            ->method('put')
            ->with(
                $this->equalTo(
                    sprintf('tenants/%s', $tenantUid)
                )
            )->willReturn($this->tenant);

        $updatedTenant = $this->tenantClient->update($this->tenant);

        self::assertSame($this->tenant->isEnabled(), $updatedTenant->isEnabled());
    }

    public function testUpdateFailure(): void
    {
        $this->tenant->setId('numero-1');

        $this->restClient
            ->expects(self::once())
            ->method('put')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->tenantClient->update($this->tenant);
    }

    public function testDelete(): void
    {
        $tenantUid = 'numero-1';
        $this->tenant->setId($tenantUid)->setVersion(1);

        $this->restClient
            ->expects(self::once())
            ->method('delete')
            ->with(
                $this->equalTo(
                    sprintf('tenants/%s?version=%d', $tenantUid, $this->tenant->getVersion())
                )
            );

        $this->tenantClient->delete(
            $this->tenant
        );
    }

    public function testDeleteFailure(): void
    {
        $this->tenant->setId('numero-1')->setVersion(1);

        $this->restClient
            ->expects(self::once())
            ->method('delete')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->tenantClient->delete($this->tenant);
    }
    */

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
