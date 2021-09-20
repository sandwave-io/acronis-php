<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Client;

use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SandwaveIo\Acronis\Client\RestClientInterface;
use SandwaveIo\Acronis\Client\UsageClient;
use SandwaveIo\Acronis\Entity\Tenant;
use SandwaveIo\Acronis\Entity\Usage;
use SandwaveIo\Acronis\Exception\AcronisException;

class UsageClientTest extends TestCase
{
    /**
     * @var MockObject|RestClientInterface
     */
    private $restClient;

    /**
     * @var UsageClient
     */
    private $usageClient;

    /**
     * @var Tenant
     */
    private $tenant;

    protected function setUp(): void
    {
        $this->restClient = $this->createMock(RestClientInterface::class);
        $this->usageClient = new UsageClient($this->restClient);
        $this->tenant = new Tenant(
            'parent-uid',
            'Test tenant',
            'customer'
        );
    }

    public function testGet(): void
    {
        $tenantUid = 'numero-1';

        $this->tenant->setId($tenantUid);

        $usageList = [
            new Usage(
                $tenantUid,
                1,
                'infra',
                'storage',
                'standard',
                'storage',
                new DateTimeImmutable(),
                0,
                0,
                'bytes'
            ),
        ];

        $this->restClient
            ->expects(self::once())
            ->method('getEntityCollection')
            ->with(
                $this->equalTo(
                    sprintf('tenants/%s/usages', $tenantUid)
                )
            )
            ->willReturn($usageList);

        $response = $this->usageClient->get($this->tenant);

        $this->assertCount(count($usageList), $response);
        $first = array_shift($response);
        $this->assertInstanceOf(Usage::class, $first);
        $this->assertSame($this->tenant->getId(), $first->getTenantUuid());
    }

    public function testGetFailure(): void
    {
        $this->tenant->setId('numero-1');

        $this->restClient
            ->expects(self::once())
            ->method('getEntityCollection')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->usageClient->get($this->tenant);
    }
}
