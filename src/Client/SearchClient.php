<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use SandwaveIo\Acronis\Entity\SearchResultCollection;
use SandwaveIo\Acronis\Exception\AcronisException;

final class SearchClient
{
    private const SEARCH = 'search?tenant=%s&text=%s&limit=%d';

    private RestClientInterface $client;

    public function __construct(RestClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws AcronisException
     */
    public function search(string $tenantId, string $text, int $limit = 10): SearchResultCollection
    {
        return $this->client->getEntity(
            sprintf(
                self::SEARCH,
                $tenantId,
                $text,
                $limit
            ),
            SearchResultCollection::class
        );
    }
}
