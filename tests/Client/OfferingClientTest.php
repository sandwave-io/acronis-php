<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Client;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SandwaveIo\Acronis\Client\OfferingClient;
use SandwaveIo\Acronis\Client\RestClientInterface;
use SandwaveIo\Acronis\Entity\Offering;
use SandwaveIo\Acronis\Entity\OfferingCollection;
use SandwaveIo\Acronis\Entity\OfferingQuota;
use SandwaveIo\Acronis\Entity\Tenant;
use SandwaveIo\Acronis\Exception\AcronisException;

class OfferingClientTest extends TestCase
{
    /**
     * @var MockObject|RestClientInterface
     */
    private $restClient;

    /**
     * @var OfferingClient
     */
    private $offeringClient;

    /**
     * @var Tenant
     */
    private $tenant;

    protected function setUp(): void
    {
        $this->restClient = $this->createMock(RestClientInterface::class);
        $this->offeringClient = new OfferingClient($this->restClient);
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

        $offeringQuota = new OfferingQuota(268435456000, 0, 1);

        $offering = new Offering(
            $tenantUid,
            'infra_id',
            'application_id',
            'bytes',
            1,
            'infra',
            'standard',
            'storage',
            'storage',
            false,
            $offeringQuota
        );

        $offeringCollection = new OfferingCollection();
        $offeringCollection->setOfferingItems([$offering]);

        $this->restClient
            ->expects(self::once())
            ->method('getEntity')
            ->with(
                $this->equalTo(
                    sprintf('tenants/%s/offering_items', $this->tenant->getId())
                )
            )
            ->willReturn($offeringCollection);

        $responeOfferingCollection = $this->offeringClient->get($this->tenant);

        $this->assertCount(count($offeringCollection->getOfferingItems()), $responeOfferingCollection->getOfferingItems());
        $offeringItems = $responeOfferingCollection->getOfferingItems();
        $first = array_shift($offeringItems);
        $this->assertInstanceOf(Offering::class, $first);
        $this->assertSame($this->tenant->getId(), $first->getTenantId());
    }

    public function testGetFailure(): void
    {
        $this->tenant->setId('numero-1');

        $this->restClient
            ->expects(self::once())
            ->method('getEntity')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->offeringClient->get($this->tenant);
    }

    public function testUpdate(): void
    {
        $tenantUid = 'numero-1';

        $this->tenant->setId($tenantUid);

        $offeringQuota = new OfferingQuota(268435456000, 0, 1);

        $offering = new Offering(
            $tenantUid,
            'infra_id',
            'application_id',
            'bytes',
            1,
            'infra',
            'standard',
            'storage',
            'storage',
            false,
            $offeringQuota
        );

        $offeringCollection = new OfferingCollection();
        $offeringCollection->setOfferingItems([$offering]);
        $expectedQuota = 53687091200;

        foreach ($offeringCollection->getOfferingItems() as $offering) {
            if ($offering->getStatus() && $offering->getName() === 'storage' && $offering->getMeasurementUnit() === 'bytes') {
                if ($offering->getQuota() instanceof OfferingQuota) {
                    $offering->getQuota()->setValue($expectedQuota);
                    $offering->getQuota()->setOverage(0);
                }
            }
        }
        $offeringCollection->setUpdatedOfferingItems($offeringCollection->getOfferingItems());

        $returnCollection = clone $offeringCollection;
        $returnCollection->setOfferingItems($offeringCollection->getOfferingItems());
        $returnCollection->setUpdatedOfferingItems([]);

        $this->restClient
            ->expects(self::once())
            ->method('put')
            ->with(
                $this->equalTo(
                    sprintf('tenants/%s/offering_items', $this->tenant->getId())
                )
            )->willReturn($returnCollection);

        $updatedCollection = $this->offeringClient->update($this->tenant, $offeringCollection);

        self::assertCount(count($offeringCollection->getOfferingItems()), $updatedCollection->getOfferingItems());
        $items = $offeringCollection->getOfferingItems();

        /** @var Offering $first */
        $first = array_shift($items);
        /** @var OfferingQuota $newOfferingQuota */
        $newOfferingQuota = $first->getQuota();

        self::assertSame($expectedQuota, $newOfferingQuota->getValue());
    }

    public function testUpdateFailure(): void
    {
        $tenantUid = 'numero-1';
        $this->tenant->setId($tenantUid);

        $offeringQuota = new OfferingQuota(268435456000, 0, 1);

        $offering = new Offering(
            $tenantUid,
            'infra_id',
            'application_id',
            'bytes',
            1,
            'infra',
            'standard',
            'storage',
            'storage',
            false,
            $offeringQuota
        );

        $offeringCollection = new OfferingCollection();
        $offeringCollection->setOfferingItems([$offering]);

        $this->restClient
            ->expects(self::once())
            ->method('put')
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->offeringClient->update($this->tenant, $offeringCollection);
    }
}
