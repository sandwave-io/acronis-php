<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use SandwaveIo\Acronis\Entity\Tenant;
use SandwaveIo\Acronis\Exception\AcronisException;

class TenantClient
{
    private const TENANT_DETAILS = 'tenants/%s';
    private const TENANT_CHILDREN = 'tenants?parent_id=%s';

    /**
     * @var RestClientInterface
     */
    private $client;

    public function __construct(RestClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws AcronisException
     */
    public function get(string $uuid): Tenant
    {
        /** @var Tenant $tenant */
        $tenant = $this->client->getAsData(sprintf(self::TENANT_DETAILS, $uuid), Tenant::class);

        return $tenant;
    }

    /**
     * @throws AcronisException
     *
     * @return Tenant[]
     */
    public function getChildren(string $parentUuid): array
    {
        return $this->client->getAsArrayOfData(sprintf(self::TENANT_CHILDREN, $parentUuid), Tenant::class);
    }
}
