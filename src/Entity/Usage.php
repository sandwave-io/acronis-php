<?php

declare(strict_types=1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class Usage
{
    /**
     * @var string
     * @Serializer\SerializedName("tenant_uuid")
     * @Serializer\Type("string")
     */
    private $tenantUuid;

    /**
     * @var int
     * @Serializer\SerializedName("tenant_id")
     * @Serializer\Type("integer")
     */
    private $tenantId;

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
     * @return string
     */
    public function getTenantUuid(): string
    {
        return $this->tenantUuid;
    }

    /**
     * @param string $tenantUuid
     * @return Usage
     */
    public function setTenantUuid(string $tenantUuid): Usage
    {
        $this->tenantUuid = $tenantUuid;

        return $this;
    }

    /**
     * @return int
     */
    public function getTenantId(): int
    {
        return $this->tenantId;
    }

    /**
     * @param int $tenantId
     * @return Usage
     */
    public function setTenantId(int $tenantId): Usage
    {
        $this->tenantId = $tenantId;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Usage
     */
    public function setType(string $type): Usage
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Usage
     */
    public function setName(string $name): Usage
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEdition(): string
    {
        return $this->edition;
    }

    /**
     * @param string $edition
     * @return Usage
     */
    public function setEdition(string $edition): Usage
    {
        $this->edition = $edition;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsageName(): string
    {
        return $this->usageName;
    }

    /**
     * @param string $usageName
     * @return Usage
     */
    public function setUsageName(string $usageName): Usage
    {
        $this->usageName = $usageName;

        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getRangeStart(): DateTimeImmutable
    {
        return $this->rangeStart;
    }

    /**
     * @param DateTimeImmutable $rangeStart
     * @return Usage
     */
    public function setRangeStart(DateTimeImmutable $rangeStart): Usage
    {
        $this->rangeStart = $rangeStart;

        return $this;
    }

    /**
     * @return int
     */
    public function getAbsoluteValue(): int
    {
        return $this->absoluteValue;
    }

    /**
     * @param int $absoluteValue
     * @return Usage
     */
    public function setAbsoluteValue(int $absoluteValue): Usage
    {
        $this->absoluteValue = $absoluteValue;

        return $this;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return Usage
     */
    public function setValue(int $value): Usage
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getMeasurementUnit(): string
    {
        return $this->measurementUnit;
    }

    /**
     * @param string $measurementUnit
     * @return Usage
     */
    public function setMeasurementUnit(string $measurementUnit): Usage
    {
        $this->measurementUnit = $measurementUnit;

        return $this;
    }
}
