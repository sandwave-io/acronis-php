<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class Usage
{
    /**
     * @var string
     * @Serializer\SerializedName("type")
     * @Serializer\Type("string")
     */
    private $type;

    /**
     * @var string
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var string
     * @Serializer\SerializedName("edition")
     * @Serializer\Type("string")
     */
    private $edition;

    /**
     * @var string
     * @Serializer\SerializedName("usage_name")
     * @Serializer\Type("string")
     */
    private $usageName;

    /**
     * @var DateTimeImmutable
     * @Serializer\SerializedName("range_start")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', 'Y-m-d\TH:i:s'>")
     */
    private $rangeStart;

    /**
     * @var int
     * @Serializer\SerializedName("absolute_value")
     * @Serializer\Type("integer")
     */
    private $absoluteValue;

    /**
     * @var int
     * @Serializer\SerializedName("value")
     * @Serializer\Type("integer")
     */
    private $value;

    /**
     * @var string
     * @Serializer\SerializedName("measurement_unit")
     * @Serializer\Type("string")
     */
    private $measurementUnit;

    /**
     * @var Offering
     * @Serializer\SerializedName("offering_item")
     * @Serializer\Type("SandwaveIo\Acronis\Entity\Offering")
     */
    private $offeringItem;

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

    public function setOfferingItem(OfferingItem $offeringItem): Usage
    {
        $this->offeringItem = $offeringItem;
        return $this;
    }
}
