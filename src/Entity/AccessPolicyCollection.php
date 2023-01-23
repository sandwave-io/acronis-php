<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use JMS\Serializer\Annotation as Serializer;

class AccessPolicyCollection
{
    /**
     * @var AccessPolicy[]
     *
     * @Serializer\Type("array<SandwaveIo\Acronis\Entity\AccessPolicy>")
     * @Serializer\SerializedName("items")
     * @Serializer\Groups({"update_data"})
     */
    private array $items;

    /**
     * @param AccessPolicy[] $items
     */
    public function __construct(array $items)
    {
        $this->setItems($items);
    }

    /**
     * @return AccessPolicy[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param AccessPolicy[] $items
     *
     * @return AccessPolicyCollection
     */
    public function setItems(array $items): AccessPolicyCollection
    {
        $this->items = $items;
        return $this;
    }
}
