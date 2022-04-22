<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use JMS\Serializer\Annotation as Serializer;

class SearchResultCollection
{
    /**
     * @var SearchResult[]
     * @Serializer\Type("array<SandwaveIo\Acronis\Entity\SearchResult>")
     * @Serializer\SerializedName("items")
     */
    private array $items;

    /**
     * @return SearchResult[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
