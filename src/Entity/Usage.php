<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class Usage
{
    /**
     * @Serializer\SerializedName("type")
     * @Serializer\Type("string")
     */
    private string $type;

    /**
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private string $name;

    /**
     * @Serializer\SerializedName("edition")
     * @Serializer\Type("string")
     */
    private string $edition;

    /**
     * @Serializer\SerializedName("usage_name")
     * @Serializer\Type("string")
     */
    private string $usageName;

    /**
     * @Serializer\SerializedName("range_start")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', 'Y-m-d\TH:i:s'>")
     */
    private DateTimeImmutable $rangeStart;

    /**
     * @Serializer\SerializedName("absolute_value")
     * @Serializer\Type("integer")
     */
    private int $absoluteValue;

    /**
     * @Serializer\SerializedName("value")
     * @Serializer\Type("integer")
     */
    private int $value;

    /**
     * @Serializer\SerializedName("measurement_unit")
     * @Serializer\Type("string")
     */
    private string $measurementUnit;

    /**
     * @Serializer\SerializedName("offering_item")
     * @Serializer\Type("SandwaveIo\Acronis\Entity\Offering")
     */
    private Offering $offeringItem;

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEdition(): string
    {
        return $this->edition;
    }

    public function getUsageName(): string
    {
        return $this->usageName;
    }

    public function getRangeStart(): DateTimeImmutable
    {
        return $this->rangeStart;
    }

    public function getAbsoluteValue(): int
    {
        return $this->absoluteValue;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getMeasurementUnit(): string
    {
        return $this->measurementUnit;
    }

    public function getOfferingItem(): Offering
    {
        return $this->offeringItem;
    }

    public function setOfferingItem(Offering $offeringItem): Usage
    {
        $this->offeringItem = $offeringItem;
        return $this;
    }
}
