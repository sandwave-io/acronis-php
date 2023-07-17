<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use JMS\Serializer\Annotation as Serializer;

class InfraUuidCollection
{
    /**
     * @var string[]
     *
     * @Serializer\Type("array<string>")
     *
     * @Serializer\SerializedName("infras")
     *
     * @Serializer\SkipWhenEmpty()
     */
    private array $items = [];

    /**
     * @return string[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
