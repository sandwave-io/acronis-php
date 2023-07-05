<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class TenantCollection
{
    /**
     * @Serializer\SerializedName("timestamp")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', 'Y-m-d\TH:i:s'>")
     */
    private DateTimeImmutable $timestamp;

    /**
     * @var Tenant[]
     *
     * @Serializer\Type("array<SandwaveIo\Acronis\Entity\Tenant>")
     * @Serializer\SerializedName("items")
     * @Serializer\SkipWhenEmpty()
     */
    private array $items = [];

    public function getTimestamp(): DateTimeImmutable
    {
        return $this->timestamp;
    }

    /**
     * @return Tenant[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
