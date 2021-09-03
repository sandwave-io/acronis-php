<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis;

use JMS\Serializer\SerializerInterface;
use SandwaveIo\Acronis\Client\RestClient;
use SandwaveIo\Acronis\Client\RestClientInterface;
use SandwaveIo\Acronis\Client\TenantClient;

final class Acronis
{
    /**
     * @var TenantClient
     */
    private $tenantClient;

    public function __construct(RestClientFactoryInterface $restClientFactory, SerializerInterface $serializer)
    {
        $restClient = new RestClient($restClientFactory, $serializer);
        $this->setClient($restClient);
    }

    public function setClient(RestClientInterface $client): void
    {
        $this->tenantClient = new TenantClient($client);
    }

    /**
     * @return TenantClient
     */
    public function getTenantClient(): TenantClient
    {
        return $this->tenantClient;
    }
}
