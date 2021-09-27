<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class UserCollection
{
    /**
     * @var DateTimeImmutable
     * @Serializer\SerializedName("timestamp")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', 'Y-m-d\TH:i:s'>")
     */
    private $timestamp;

    /**
     * @var User[]
     * @Serializer\Type("array<SandwaveIo\Acronis\Entity\User>")
     * @Serializer\SerializedName("items")
     */
    private $items;

    public function getTimestamp(): DateTimeImmutable
    {
        return $this->timestamp;
    }

    /**
     * @return User[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
