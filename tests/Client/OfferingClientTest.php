<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Tests\Client;

use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SandwaveIo\Acronis\Client\OfferingClient;
use SandwaveIo\Acronis\Client\RestClientInterface;
use SandwaveIo\Acronis\Entity\Contact;
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

    protected function setUp(): void
    {
        $this->restClient = $this->createMock(RestClientInterface::class);
        $this->offeringClient = new OfferingClient($this->restClient);
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

        $offeringQuota = new OfferingQuota(1, 0, 268435456000);

        $offering = new Offering(
            $tenant->getId(),
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
                    sprintf('tenants/%s/offering_items', $tenant->getId())
                )
            )
            ->willReturn($offeringCollection);

        $responeOfferingCollection = $this->offeringClient->get($tenant);

        $this->assertCount(count($offeringCollection->getOfferingItems()), $responeOfferingCollection->getOfferingItems());
        $offeringItems = $responeOfferingCollection->getOfferingItems();
        $first = array_shift($offeringItems);
        $this->assertInstanceOf(Offering::class, $first);
        $this->assertSame($tenant->getId(), $first->getTenantId());
    }

    public function testGetFailure(): void
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
            ->will(
                $this->throwException(
                    new AcronisException('fake exception')
                )
            );

        self::expectException(AcronisException::class);
        $this->offeringClient->get($tenant);
    }

    public function testUpdate(): void
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

        $offeringQuota = new OfferingQuota(1, 0, 268435456000);

        $offering = new Offering(
            $tenant->getId(),
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
        $newQuota = 53687091200;

        foreach ($offeringCollection->getOfferingItems() as $offering) {
            if ($offering->getStatus() && $offering->getName() === 'storage' && $offering->getMeasurementUnit() === 'bytes') {
                $offering->getQuota()->setValue($newQuota);
                $offering->getQuota()->setOverage(0);
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
                    sprintf('tenants/%s/offering_items', $tenant->getId())
                )
            )->willReturn($returnCollection);

        $updatedCollection = $this->offeringClient->update($tenant, $offeringCollection);

        self::assertCount(count($offeringCollection->getOfferingItems()), $updatedCollection->getOfferingItems());
        $items = $offeringCollection->getOfferingItems();
        $first = array_shift($items);
        self::assertSame($newQuota, $first->getQuota()->getValue());
    }

    public function testUpdateFailure(): void
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

        $offeringQuota = new OfferingQuota(1, 0, 268435456000);

        $offering = new Offering(
            $tenant->getId(),
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
        $this->offeringClient->update($tenant, $offeringCollection);
    }
}
