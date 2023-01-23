<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use JMS\Serializer\Annotation as Serializer;

class UserUuidCollection
{
    /**
     * @var string[]
     *
     * @Serializer\Type("array<string>")
     * @Serializer\SerializedName("items")
     */
    private array $items;

    /**
     * @return string[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
