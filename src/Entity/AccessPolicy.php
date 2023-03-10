<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use JMS\Serializer\Annotation as Serializer;

class AccessPolicy
{
    /**
     * @Serializer\SerializedName("id")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"update_data"})
     */
    private ?string $id;

    /**
     * @Serializer\SerializedName("issuer_id")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"update_data"})
     */
    private string $issuerId;

    /**
     * @Serializer\SerializedName("role_id")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"update_data"})
     */
    private string $roleId;

    /**
     * @Serializer\SerializedName("tenant_id")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"update_data"})
     */
    private string $tenantId;

    /**
     * @Serializer\SerializedName("trustee_id")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"update_data"})
     */
    private string $trusteeId;

    /**
     * @Serializer\SerializedName("trustee_type")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"update_data"})
     */
    private string $trusteeType;

    /**
     * @Serializer\SerializedName("version")
     *
     * @Serializer\Type("integer")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private int $version;

    public function __construct(
        ?string $id,
        ?string $issuerId,
        string $tenantId,
        string $trusteeId,
        string $roleId = 'backup_user',
        string $trusteeType = 'user',
        int $version = 0
    ) {
        if ($issuerId === null) {
            $issuerId = $tenantId;
        }
        $this->setId($id)
            ->setIssuerId($issuerId)
            ->setTenantId($tenantId)
            ->setTrusteeId($trusteeId)
            ->setRoleId($roleId)
            ->setTrusteeType($trusteeType)
            ->setVersion($version);
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): AccessPolicy
    {
        $this->id = $id;
        return $this;
    }

    public function getIssuerId(): string
    {
        return $this->issuerId;
    }

    public function setIssuerId(string $issuerId): AccessPolicy
    {
        $this->issuerId = $issuerId;
        return $this;
    }

    public function getRoleId(): string
    {
        return $this->roleId;
    }

    public function setRoleId(string $roleId): AccessPolicy
    {
        $this->roleId = $roleId;
        return $this;
    }

    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    public function setTenantId(string $tenantId): AccessPolicy
    {
        $this->tenantId = $tenantId;
        return $this;
    }

    public function getTrusteeId(): string
    {
        return $this->trusteeId;
    }

    public function setTrusteeId(string $trusteeId): AccessPolicy
    {
        $this->trusteeId = $trusteeId;
        return $this;
    }

    public function getTrusteeType(): string
    {
        return $this->trusteeType;
    }

    public function setTrusteeType(string $trusteeType): AccessPolicy
    {
        $this->trusteeType = $trusteeType;
        return $this;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): AccessPolicy
    {
        $this->version = $version;
        return $this;
    }
}
