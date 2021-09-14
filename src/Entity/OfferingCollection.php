<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use JMS\Serializer\Annotation as Serializer;

class OfferingCollection
{
    /**
     * @var Offering[]
     * @Serializer\Type("array<SandwaveIo\Acronis\Entity\Offering>")
     * @Serializer\SerializedName("items")
     */
    private $offeringItems;

    /**
     * @var Offering[]
     * @Serializer\Type("array<SandwaveIo\Acronis\Entity\Offering>")
     * @Serializer\SerializedName("offering_items")
     * @Serializer\Groups({"update_data"})
     */
    private $updatedOfferingItems;

    public function __construct()
    {
        $this->offeringItems = [];
        $this->updatedOfferingItems = [];
    }

    public function getOfferingItems(): array
    {
        return $this->offeringItems;
    }

    public function setOfferingItems(array $offeringItems): OfferingCollection
    {
        $this->offeringItems = $offeringItems;

        return $this;
    }

    public function getUpdatedOfferingItems(): array
    {
        return $this->updatedOfferingItems;
    }

    public function setUpdatedOfferingItems(array $updatedOfferingItems): OfferingCollection
    {
        $this->updatedOfferingItems = $updatedOfferingItems;

        return $this;
    }
}
