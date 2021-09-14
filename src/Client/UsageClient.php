<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use SandwaveIo\Acronis\Entity\Tenant;
use SandwaveIo\Acronis\Entity\Usage;
use SandwaveIo\Acronis\Exception\AcronisException;

class UsageClient
{
    private const TENANT_USAGES = 'tenants/%s/usages';

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
     * @return Usage[]
     */
    public function get(Tenant $tenant): array
    {
        return $this->client->getEntityCollection(sprintf(self::TENANT_USAGES, $tenant->getId()), Usage::class);
    }
}
