<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use SandwaveIo\Acronis\Entity\Tenant;
use SandwaveIo\Acronis\Exception\AcronisException;

class TenantClient
{
    private const TENANT_LIST = 'tenants';
    private const TENANT_DETAILS = 'tenants/%s';
    private const TENANT_CHILDREN = 'tenants?parent_id=%s';
    private const TENANT_DELETE = 'tenants/%s?version=%d';
    private const TENANT_USERS = 'tenants/%s/users';
    private const TENANT_APPLICATIONS = 'tenants/%s/applications';
    private const TENANT_INFRA = 'tenants/%s/infra';

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
        $tenant = $this->client->getEntity(sprintf(self::TENANT_DETAILS, $uuid), Tenant::class);

        return $tenant;
    }

    /**
     * @throws AcronisException
     *
     * @return Tenant[]
     */
    public function getChildren(string $parentUuid): array
    {
        return $this->client->getEntityCollection(sprintf(self::TENANT_CHILDREN, $parentUuid), Tenant::class);
    }

    public function create(Tenant $tenant): Tenant
    {
        /** @var Tenant $createdTenant */
        $createdTenant = $this->client->post(self::TENANT_LIST, $tenant);

        return $createdTenant;
    }

    public function update(Tenant $tenant): Tenant
    {
        /** @var Tenant $updatedTenant */
        $updatedTenant = $this->client->put(sprintf(self::TENANT_DETAILS, $tenant->getId()), $tenant);

        return $updatedTenant;
    }

    /**
     * @param string $tenantUuid
     *
     * @return string[]
     */
    public function getUsersByTenantUuid(string $tenantUuid): array
    {
        return json_decode($this->client->getRawData(sprintf(self::TENANT_USERS, $tenantUuid)))->items;
    }

    /**
     * @throws AcronisException
     */
    public function delete(Tenant $tenant): void
    {
        $this->client->delete(
            sprintf(self::TENANT_DELETE, $tenant->getId(), $tenant->getVersion())
        );
    }

    public function getApplications(string $tenantUuid): string
    {
        return $this->client->getRawData(sprintf(self::TENANT_APPLICATIONS, $tenantUuid));
    }

    public function getInfra(string $tenantUuid): string
    {
        return $this->client->getRawData(sprintf(self::TENANT_INFRA, $tenantUuid));
    }
}
