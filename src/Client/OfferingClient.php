<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use SandwaveIo\Acronis\Entity\OfferingCollection;
use SandwaveIo\Acronis\Entity\Tenant;
use SandwaveIo\Acronis\Exception\AcronisException;

class OfferingClient
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
     * @param Tenant $tenant
     *
     * @throws AcronisException
     *
     * @return OfferingCollection
     */
    public function get(Tenant $tenant): OfferingCollection
    {
        /** @var OfferingCollection $offeringCollection */
        $offeringCollection = $this->client->getEntity(sprintf(self::OFFERING_ITEMS, $tenant->getId()), OfferingCollection::class);

        return $offeringCollection;
    }

    /**
     * @param Tenant             $tenant
     * @param OfferingCollection $offeringItems
     *
     * @throws AcronisException
     *
     * @return OfferingCollection
     */
    public function update(Tenant $tenant, OfferingCollection $offeringItems): OfferingCollection
    {
        /** @var OfferingCollection $updatedOfferingCollection */
        $updatedOfferingCollection = $this->client->put(sprintf(self::OFFERING_ITEMS, $tenant->getId()), $offeringItems);

        return $updatedOfferingCollection;
    }
}
