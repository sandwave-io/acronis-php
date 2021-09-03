<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis;

use SandwaveIo\Acronis\Client\RestClientInterface;
use SandwaveIo\Acronis\Client\TenantClient;

final class Acronis
{
    /**
     * @var TenantClient
     */
    private $tenantClient;

    public function __construct(RestClientInterface $restClient)
    {
        $this->setClient($restClient);
    }

    private function setClient(RestClientInterface $client): void
    {
        $this->tenantClient = new TenantClient($client);
    }

    public function getTenantClient(): TenantClient
    {
        return $this->tenantClient;
    }
}
