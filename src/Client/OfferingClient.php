<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use SandwaveIo\Acronis\Entity\OfferingCollection;
use SandwaveIo\Acronis\Exception\AcronisException;

final class OfferingClient
{
    private const OFFERING_ITEMS = 'tenants/%s/offering_items?edition=*';

    private RestClientInterface $client;

    public function __construct(RestClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws AcronisException
     */
    public function get(string $tenantUuid): OfferingCollection
    {
        return $this->client->getEntity(sprintf(self::OFFERING_ITEMS, $tenantUuid), OfferingCollection::class);
    }

    /**
     * @throws AcronisException
     */
    public function update(string $tenantUuid, OfferingCollection $offeringItems): OfferingCollection
    {
        return $this->client->put(sprintf(self::OFFERING_ITEMS, $tenantUuid), $offeringItems, OfferingCollection::class);
    }
}
