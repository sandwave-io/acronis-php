<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class TenantPricing
{
    /**
     * @var string|null
     * @Serializer\SerializedName("mode")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private $mode;

    /**
     * @var int|null
     * @Serializer\SerializedName("version")
     * @Serializer\Type("integer")
     * @Serializer\Groups({"update_data"})
     */
    private $version;

    /**
     * @var string|null
     * @Serializer\SerializedName("mode")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private $currency;

    /**
     * @var DateTimeImmutable|null
     * @Serializer\SerializedName("production_start_date")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', ['Y-m-d\TH:i:s']>")
     */
    private $productionStartDate;

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(?string $mode): TenantPricing
    {
        $this->mode = $mode;
        return $this;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(?int $version): TenantPricing
    {
        $this->version = $version;
        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): TenantPricing
    {
        $this->currency = $currency;
        return $this;
    }

    public function getProductionStartDate(): ?DateTimeImmutable
    {
        return $this->productionStartDate;
    }

    public function setProductionStartDate(?DateTimeImmutable $productionStartDate): TenantPricing
    {
        $this->productionStartDate = $productionStartDate;
        return $this;
    }
}
