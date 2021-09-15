<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Client;

use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SandwaveIo\Acronis\Client\RestClientInterface;
use SandwaveIo\Acronis\Client\UsageClient;
use SandwaveIo\Acronis\Entity\Contact;
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

    protected function setUp(): void
    {
        $this->restClient = $this->createMock(RestClientInterface::class);
        $this->usageClient = new UsageClient($this->restClient);
    }

    public function testGet(): void
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

        $usageList = [
            new Usage(
                $tenant->getId(),
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
                    sprintf('tenants/%s/usages', $tenant->getId())
                )
            )
            ->willReturn($usageList);

        $response = $this->usageClient->get($tenant);

        $this->assertCount(count($usageList), $response);
        $first = array_shift($response);
        $this->assertInstanceOf(Usage::class, $first);
        $this->assertSame($tenant->getId(), $first->getTenantUuid());
    }

    public function testGetFailure(): void
    {
        $tenantMock = $this->createMock(Tenant::class);
        $tenantMock->setId('numero-1');

        $this->restClient
            ->expects(self::once())
            ->method('getEntityCollection')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->usageClient->get($tenantMock);
    }
}
