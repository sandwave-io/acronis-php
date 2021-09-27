<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use SandwaveIo\Acronis\Entity\ApplicationUuidCollection;
use SandwaveIo\Acronis\Entity\InfraUuidCollection;
use SandwaveIo\Acronis\Entity\Tenant;
use SandwaveIo\Acronis\Entity\TenantCollection;
use SandwaveIo\Acronis\Entity\UsageCollection;
use SandwaveIo\Acronis\Entity\UserUuidCollection;
use SandwaveIo\Acronis\Exception\AcronisException;

final class TenantClient
{
    private const TENANT_LIST = 'tenants';
    private const TENANT_DETAILS = 'tenants/%s';
    private const TENANT_CHILDREN = 'tenants?parent_id=%s';
    private const TENANT_DELETE = 'tenants/%s?version=%d';
    private const TENANT_USERS = 'tenants/%s/users';
    private const TENANT_APPLICATIONS = 'tenants/%s/applications';
    private const TENANT_INFRA = 'tenants/%s/infra';
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
     */
    public function getChildren(string $parentUuid): TenantCollection
    {
        /** @var TenantCollection $tenantCollection */
        $tenantCollection = $this->client->getEntity(sprintf(self::TENANT_CHILDREN, $parentUuid), TenantCollection::class);

        return $tenantCollection;
    }

    /**
     * @throws AcronisException
     */
    public function create(Tenant $tenant): Tenant
    {
        /** @var Tenant $createdTenant */
        $createdTenant = $this->client->post(self::TENANT_LIST, $tenant);

        return $createdTenant;
    }

    /**
     * @throws AcronisException
     */
    public function update(Tenant $tenant): Tenant
    {
        /** @var Tenant $updatedTenant */
        $updatedTenant = $this->client->put(sprintf(self::TENANT_DETAILS, $tenant->getId()), $tenant);

        return $updatedTenant;
    }

    /**
     * @throws AcronisException
     */
    public function getUsersByTenantUuid(string $tenantUuid): UserUuidCollection
    {
        /** @var UserUuidCollection $userUuidCollection */
        $userUuidCollection = $this->client->getEntity(sprintf(self::TENANT_USERS, $tenantUuid), UserUuidCollection::class);

        return $userUuidCollection;
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

    /**
     * @throws AcronisException
     */
    public function getAvailableApplications(string $tenantUuid): ApplicationUuidCollection
    {
        /** @var ApplicationUuidCollection $applicationUuidCollection */
        $applicationUuidCollection = $this->client->getEntity(sprintf(self::TENANT_APPLICATIONS, $tenantUuid), ApplicationUuidCollection::class);

        return $applicationUuidCollection;
    }

    /**
     * @throws AcronisException
     */
    public function getInfra(string $tenantUuid): InfraUuidCollection
    {
        /** @var InfraUuidCollection $infraUuidCollection */
        $infraUuidCollection = $this->client->getEntity(sprintf(self::TENANT_INFRA, $tenantUuid), InfraUuidCollection::class);

        return $infraUuidCollection;
    }

    /**
     * @throws AcronisException
     */
    public function getUsage(string $tenantUuid): UsageCollection
    {
        /** @var UsageCollection $usageCollection */
        $usageCollection = $this->client->getEntity(sprintf(self::TENANT_USAGES, $tenantUuid), UsageCollection::class);

        return $usageCollection;
    }
}
