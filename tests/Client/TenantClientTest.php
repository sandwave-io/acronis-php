<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Client;

use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SandwaveIo\Acronis\Client\RestClientInterface;
use SandwaveIo\Acronis\Client\TenantClient;
use SandwaveIo\Acronis\Entity\Contact;
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

    public function testGetEntity(): void
    {
        $tenantUid = 'numero-1';

        $tenant = new Tenant(
            1,
            'parent-uid',
            'brand-uid',
            1,
            'customer-uid',
            'name',
            'internal-tag',
            'customer-type',
            'mfa-status',
            'kind',
            'pricing-mode',
            'nl',
            true,
            false,
            false,
            new DateTimeImmutable(),
            new DateTimeImmutable(),
            new Contact(),
            $tenantUid,
        );

        $this->restClient
            ->expects(self::once())
            ->method('getEntity')
            ->with(
                $this->equalTo(
                    sprintf('tenants/%s', $tenantUid)
                )
            )
            ->willReturn($tenant);

        $responeTenant = $this->tenantClient->get($tenantUid);

        self::assertSame($tenantUid, $responeTenant->getId());
    }

    public function testGetEntityFailure(): void
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
            new Tenant(
                1,
                'parent-uid',
                'brand-uid',
                1,
                'customer-uid',
                'name',
                'internal-tag',
                'customer-type',
                'mfa-status',
                'kind',
                'pricing-mode',
                'nl',
                true,
                false,
                false,
                new DateTimeImmutable(),
                new DateTimeImmutable(),
                new Contact(),
                $tenantUid,
            ),
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

        $this->assertIsArray($response);
        $this->assertCount(count($tenantList), $response);
        $first = array_shift($response);
        $this->assertInstanceOf(Tenant::class, $first);
        $this->assertSame('name', $first->getName());
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

    public function testUpdate(): void
    {
        $tenantMock = $this->createMock(Tenant::class);
        $tenantMock->setId('numero-1');
        $tenantMock->setVersion(2);

        $this->restClient
            ->expects(self::once())
            ->method('put')
            ->with(
                $this->equalTo(
                    sprintf('tenants/%s', $tenantMock->getId())
                )
            )->willReturn($tenantMock);

        $updatedTenant = $this->tenantClient->update($tenantMock);

        self::assertSame($tenantMock->getVersion(), $updatedTenant->getVersion());
    }

    public function testUpdateFailure(): void
    {
        $this->restClient
            ->expects(self::once())
            ->method('put')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->tenantClient->update($this->createMock(Tenant::class));
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
