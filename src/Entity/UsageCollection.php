<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use JMS\Serializer\Annotation as Serializer;

class UsageCollection
{
    /**
     * @var Usage[]
     *
     * @Serializer\Type("array<SandwaveIo\Acronis\Entity\Usage>")
     * @Serializer\SerializedName("items")
     * @Serializer\SkipWhenEmpty()
     */
    private array $items = [];

    /**
     * @return Usage[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
