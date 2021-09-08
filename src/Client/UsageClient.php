<?php

declare(strict_types=1);

namespace SandwaveIo\Acronis\Client;

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
     * @param string $uuid
     * @return Usage[]
     * @throws AcronisException
     */
    public function get(string $uuid): array
    {
        return $this->client->getAsArrayOfData(sprintf(self::TENANT_USAGES, $uuid), Usage::class);
    }
}
