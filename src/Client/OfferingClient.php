<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use SandwaveIo\Acronis\Entity\OfferingCollection;
use SandwaveIo\Acronis\Entity\Tenant;
use SandwaveIo\Acronis\Exception\AcronisException;

final class OfferingClient
{
    private const OFFERING_ITEMS = 'tenants/%s/offering_items';

    /**
     * @var RestClientInterface
     */
    private $client;

    public function __construct(RestClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $tenantUuid
     *
     * @throws AcronisException
     *
     * @return OfferingCollection
     */
    public function get(string $tenantUuid): OfferingCollection
    {
        /** @var OfferingCollection $offeringCollection */
        $offeringCollection = $this->client->getEntity(sprintf(self::OFFERING_ITEMS, $tenantUuid), OfferingCollection::class);

        return $offeringCollection;
    }

    /**
     * @param string             $tenantUuid
     * @param OfferingCollection $offeringItems
     *
     * @throws AcronisException
     *
     * @return OfferingCollection
     */
    public function update(string $tenantUuid, OfferingCollection $offeringItems): OfferingCollection
    {
        /** @var OfferingCollection $updatedOfferingCollection */
        $updatedOfferingCollection = $this->client->put(sprintf(self::OFFERING_ITEMS, $tenantUuid), $offeringItems);

        return $updatedOfferingCollection;
    }
}
