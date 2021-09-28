<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use JMS\Serializer\Annotation as Serializer;

class TenantEdition
{
    /**
     * @var string
     * @Serializer\SerializedName("target_edition")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private $edition;

    /**
     * @var string
     * @Serializer\SerializedName("application_id")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private $applicationId;

    public function __construct(string $edition, string $applicationId)
    {
        $this->setEdition($edition)
            ->setApplicationId($applicationId);
    }

    public function getEdition(): string
    {
        return $this->edition;
    }

    public function setEdition(string $edition): TenantEdition
    {
        $this->edition = $edition;

        return $this;
    }

    public function getApplicationId(): string
    {
        return $this->applicationId;
    }

    public function setApplicationId(string $applicationId): TenantEdition
    {
        $this->applicationId = $applicationId;

        return $this;
    }
}
