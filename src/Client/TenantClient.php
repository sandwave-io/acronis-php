<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use SandwaveIo\Acronis\Entity\ApplicationUuidCollection;
use SandwaveIo\Acronis\Entity\InfraUuidCollection;
use SandwaveIo\Acronis\Entity\OfferingCollection;
use SandwaveIo\Acronis\Entity\Tenant;
use SandwaveIo\Acronis\Entity\TenantCollection;
use SandwaveIo\Acronis\Entity\TenantEdition;
use SandwaveIo\Acronis\Entity\TenantPricing;
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
    private const TENANT_EDITION = 'tenants/%s/edition';
    private const TENANT_PRICING = 'tenants/%s/pricing';

    private RestClientInterface $client;

    public function __construct(RestClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws AcronisException
     */
    public function list(): TenantCollection
    {
        return $this->client->getEntity(self::TENANT_DETAILS, TenantCollection::class);
    }

    /**
     * @throws AcronisException
     */
    public function get(string $uuid): Tenant
    {
        return $this->client->getEntity(sprintf(self::TENANT_DETAILS, $uuid), Tenant::class);
    }

    /**
     * @throws AcronisException
     */
    public function getChildren(string $parentUuid): TenantCollection
    {
        return $this->client->getEntity(sprintf(self::TENANT_CHILDREN, $parentUuid), TenantCollection::class);
    }

    /**
     * @throws AcronisException
     */
    public function create(Tenant $tenant): Tenant
    {
        return $this->client->post(self::TENANT_LIST, $tenant, Tenant::class);
    }

    /**
     * @throws AcronisException
     */
    public function update(Tenant $tenant): Tenant
    {
        return $this->client->put(sprintf(self::TENANT_DETAILS, $tenant->getId()), $tenant, Tenant::class);
    }

    /**
     * @throws AcronisException
     */
    public function getUsersByTenantUuid(string $tenantUuid): UserUuidCollection
    {
        return $this->client->getEntity(sprintf(self::TENANT_USERS, $tenantUuid), UserUuidCollection::class);
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
    public function getPricing(string $tenantUuid): TenantPricing
    {
        return $this->client->getEntity(sprintf(self::TENANT_PRICING, $tenantUuid), TenantPricing::class);
    }

    /**
     * @throws AcronisException
     */
    public function updatePricing(string $tenantUuid, TenantPricing $tenantPricing): TenantPricing
    {
        return $this->client->put(sprintf(self::TENANT_PRICING, $tenantUuid), $tenantPricing, TenantPricing::class);
    }

    /**
     * @throws AcronisException
     */
    public function getAvailableApplications(string $tenantUuid): ApplicationUuidCollection
    {
        return $this->client->getEntity(sprintf(self::TENANT_APPLICATIONS, $tenantUuid), ApplicationUuidCollection::class);
    }

    /**
     * @throws AcronisException
     */
    public function getInfra(string $tenantUuid): InfraUuidCollection
    {
        return $this->client->getEntity(sprintf(self::TENANT_INFRA, $tenantUuid), InfraUuidCollection::class);
    }

    /**
     * @throws AcronisException
     */
    public function getUsage(string $tenantUuid): UsageCollection
    {
        return $this->client->getEntity(sprintf(self::TENANT_USAGES, $tenantUuid), UsageCollection::class);
    }

    public function switchEdition(string $tenantUuid, TenantEdition $tenantEditionSwitch): OfferingCollection
    {
        return $this->client->put(sprintf(self::TENANT_EDITION, $tenantUuid), $tenantEditionSwitch, OfferingCollection::class);
    }
}
