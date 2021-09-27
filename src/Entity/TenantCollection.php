<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class TenantCollection
{
    /**
     * @var DateTimeImmutable
     * @Serializer\SerializedName("timestamp")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', 'Y-m-d\TH:i:s'>")
     */
    private $timestamp;

    /**
     * @var Tenant[]
     * @Serializer\Type("array<SandwaveIo\Acronis\Entity\Tenant>")
     * @Serializer\SerializedName("items")
     */
    private $items;

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