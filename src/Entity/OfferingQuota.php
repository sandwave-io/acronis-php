<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use JMS\Serializer\Annotation as Serializer;

class OfferingQuota
{
    /**
     * @Serializer\SerializedName("version")
     *
     * @Serializer\Type("integer")
     *
     * @Serializer\Groups({"update_data"})
     */
    private ?int $version;

    /**
     * @Serializer\SerializedName("overage")
     *
     * @Serializer\Type("integer")
     *
     * @Serializer\Groups({"update_data"})
     */
    private ?int $overage;

    /**
     * @Serializer\SerializedName("value")
     *
     * @Serializer\Type("integer")
     *
     * @Serializer\Groups({"update_data"})
     */
    private ?int $value;

    public function __construct(?int $value, ?int $overage = null, ?int $version = null)
    {
        $this->setValue($value)
            ->setOverage($overage)
            ->setVersion($version);
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(?int $version): OfferingQuota
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
