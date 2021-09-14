<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use JMS\Serializer\Annotation as Serializer;

class OfferingQuota
{
    /**
     * @var int
     * @Serializer\SerializedName("version")
     * @Serializer\Type("integer")
     * @Serializer\Groups({"update_data"})
     */
    private $version;

    /**
     * @var int|null
     * @Serializer\SerializedName("overage")
     * @Serializer\Type("integer")
     * @Serializer\Groups({"update_data"})
     */
    private $overage;

    /**
     * @var int|null
     * @Serializer\SerializedName("value")
     * @Serializer\Type("integer")
     * @Serializer\Groups({"update_data"})
     */
    private $value;

    public function __construct(int $version, ?int $overage, ?int $value)
    {
        $this->version = $version;
        $this->overage = $overage;
        $this->value = $value;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): OfferingQuota
    {
        $this->version = $version;

        return $this;
    }

    public function getOverage(): ?int
    {
        return $this->overage;
    }

    public function setOverage(?int $overage): OfferingQuota
    {
        $this->overage = $overage;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?int $value): OfferingQuota
    {
        $this->value = $value;

        return $this;
    }
}
