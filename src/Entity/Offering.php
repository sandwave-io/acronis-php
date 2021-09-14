<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use JMS\Serializer\Annotation as Serializer;

class Offering
{
    /**
     * @var string
     * @Serializer\SerializedName("tenant_id")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private $tenantId;

    /**
     * @var string
     * @Serializer\SerializedName("infra_id")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private $infraId;

    /**
     * @var string
     * @Serializer\SerializedName("application_id")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private $applicationId;

    /**
     * @var string
     * @Serializer\SerializedName("measurement_unit")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private $measurementUnit;

    /**
     * @var int
     * @Serializer\SerializedName("status")
     * @Serializer\Type("integer")
     * @Serializer\Groups({"update_data"})
     */
    private $status;

    /**
     * @var string
     * @Serializer\SerializedName("type")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private $type;

    /**
     * @var string
     * @Serializer\SerializedName("edition")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private $edition;

    /**
     * @var string
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private $name;

    /**
     * @var string
     * @Serializer\SerializedName("usage_name")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private $usageName;

    /**
     * @var bool
     * @Serializer\SerializedName("locked")
     * @Serializer\Type("boolean")
     * @Serializer\Groups({"update_data"})
     */
    private $locked;

    /**
     * @var OfferingQuota
     * @Serializer\SerializedName("quota")
     * @Serializer\Type("SandwaveIo\Acronis\Entity\OfferingQuota")
     * @Serializer\Groups({"update_data"})
     */
    private $quota;

    public function __construct(
        string $tenantId,
        string $infraId,
        string $applicationId,
        string $measurementUnit,
        int $status,
        string $type,
        string $edition,
        string $name,
        string $usageName,
        bool $locked,
        OfferingQuota $quota
    ) {
        $this->tenantId = $tenantId;
        $this->infraId = $infraId;
        $this->applicationId = $applicationId;
        $this->measurementUnit = $measurementUnit;
        $this->status = $status;
        $this->type = $type;
        $this->edition = $edition;
        $this->name = $name;
        $this->usageName = $usageName;
        $this->locked = $locked;
        $this->quota = $quota;
    }

    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    public function setTenantId(string $tenantId): Offering
    {
        $this->tenantId = $tenantId;

        return $this;
    }

    public function getInfraId(): string
    {
        return $this->infraId;
    }

    public function setInfraId(string $infraId): Offering
    {
        $this->infraId = $infraId;

        return $this;
    }

    public function getApplicationId(): string
    {
        return $this->applicationId;
    }

    public function setApplicationId(string $applicationId): Offering
    {
        $this->applicationId = $applicationId;

        return $this;
    }

    public function getMeasurementUnit(): string
    {
        return $this->measurementUnit;
    }

    public function setMeasurementUnit(string $measurementUnit): Offering
    {
        $this->measurementUnit = $measurementUnit;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): Offering
    {
        $this->status = $status;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): Offering
    {
        $this->type = $type;

        return $this;
    }

    public function getEdition(): string
    {
        return $this->edition;
    }

    public function setEdition(string $edition): Offering
    {
        $this->edition = $edition;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Offering
    {
        $this->name = $name;

        return $this;
    }

    public function getUsageName(): string
    {
        return $this->usageName;
    }

    public function setUsageName(string $usageName): Offering
    {
        $this->usageName = $usageName;

        return $this;
    }

    public function isLocked(): bool
    {
        return $this->locked;
    }

    public function setLocked(bool $locked): Offering
    {
        $this->locked = $locked;

        return $this;
    }

    public function getQuota(): OfferingQuota
    {
        return $this->quota;
    }

    public function setQuota(OfferingQuota $quota): Offering
    {
        $this->quota = $quota;

        return $this;
    }
}
