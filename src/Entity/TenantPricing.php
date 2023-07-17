<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class TenantPricing
{
    /**
     * @Serializer\SerializedName("mode")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"update_data"})
     */
    private ?string $mode = null;

    /**
     * @Serializer\SerializedName("version")
     *
     * @Serializer\Type("integer")
     *
     * @Serializer\Groups({"update_data"})
     */
    private ?int $version = null;

    /**
     * @Serializer\SerializedName("mode")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"update_data"})
     */
    private ?string $currency = null;

    /**
     * @Serializer\SerializedName("production_start_date")
     *
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', ['Y-m-d\TH:i:s\Z', 'Y-m-d\TH:i:s']>")
     */
    private ?DateTimeImmutable $productionStartDate = null;

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
