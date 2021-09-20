<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis;

use SandwaveIo\Acronis\Client\OfferingClient;
use SandwaveIo\Acronis\Client\RestClientInterface;
use SandwaveIo\Acronis\Client\SearchClient;
use SandwaveIo\Acronis\Client\TenantClient;
use SandwaveIo\Acronis\Client\UsageClient;
use SandwaveIo\Acronis\Client\UserClient;

final class AcronisApi
{
    /**
     * @var TenantClient
     */
    private $tenantClient;

    /**
     * @var UserClient
     */
    private $userClient;

    /**
     * @var UsageClient
     */
    private $usageClient;

    /**
     * @var OfferingClient
     */
    private $offeringClient;

    /**
     * @var SearchClient
     */
    private $searchClient;

    public function __construct(RestClientInterface $restClient)
    {
        $this->setClient($restClient);
    }

    public function getTenantClient(): TenantClient
    {
        return $this->tenantClient;
    }

    public function getUserClient(): UserClient
    {
        return $this->userClient;
    }

    public function getUsageClient(): UsageClient
    {
        return $this->usageClient;
    }

    public function getOfferingClient(): OfferingClient
    {
        return $this->offeringClient;
    }

    public function getSearchClient(): SearchClient
    {
        return $this->searchClient;
    }

    private function setClient(RestClientInterface $client): void
    {
        $this->tenantClient = new TenantClient($client);
        $this->userClient = new UserClient($client);
        $this->usageClient = new UsageClient($client);
        $this->offeringClient = new OfferingClient($client);
        $this->searchClient = new SearchClient($client);
    }
}
