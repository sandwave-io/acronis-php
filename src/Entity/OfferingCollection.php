<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class OfferingCollection
{
    /**
     * @var Offering[]
     *
     * @Serializer\Type("array<SandwaveIo\Acronis\Entity\Offering>")
     *
     * @Serializer\SerializedName("items")
     *
     * @Serializer\SkipWhenEmpty()
     */
    private array $offeringItems = [];

    /**
     * @var Offering[]
     *
     * @Serializer\Type("array<SandwaveIo\Acronis\Entity\Offering>")
     *
     * @Serializer\SerializedName("offering_items")
     *
     * @Serializer\Groups({"update_data"})
     *
     * @Serializer\SkipWhenEmpty()
     */
    private array $updatedOfferingItems = [];

    public function __construct()
    {
        $this->offeringItems = [];
        $this->updatedOfferingItems = [];
    }

    /**
     * @return array|Offering[]
     */
    public function getItems(): array
    {
        return $this->offeringItems;
    }

    /**
     * @param Offering[] $offeringItems
     *
     * @return OfferingCollection
     */
    public function setItems(array $offeringItems): OfferingCollection
    {
        $this->offeringItems = $this->updatedOfferingItems = $offeringItems;

        return $this;
    }
}
