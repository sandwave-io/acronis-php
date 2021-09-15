<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Client;

use SandwaveIo\Acronis\Entity\SearchResult;

class SearchClient
{
    private const SEARCH = 'search?tenant=%s&text=%s&limit=%d';

    /**
     * @var RestClientInterface
     */
    private $client;

    public function __construct(RestClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $tenantId
     * @param string $text
     * @param int $limit
     * @return SearchResult[]
     */
    public function search(string $tenantId, string $text, int $limit = 10): array
    {
        /** @var SearchResult[] $searchResults */
        $searchResults = $this->client->getEntityCollection(
            sprintf(
                self::SEARCH,
                $tenantId,
                $text,
                $limit
            ),
            SearchResult::class
        );

        return $searchResults;
    }
}
