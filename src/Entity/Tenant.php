<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class Tenant
{
    /**
     * @var string
     * @Serializer\SerializedName("id")
     * @Serializer\Type("string")
     */
    private $id;

    /**
     * @var string
     * @Serializer\SerializedName("parent_id")
     * @Serializer\Type("string")
     */
    private $parentId;

    /**
     * @var string|null
     * @Serializer\SerializedName("owner_id")
     * @Serializer\Type("string")
     */
    private $ownerId;

    /**
     * @var string
     * @Serializer\SerializedName("brand_uuid")
     * @Serializer\Type("string")
     */
    private $brandUuid;

    /**
     * @var int
     * @Serializer\SerializedName("brand_id")
     * @Serializer\Type("integer")
     */
    private $brandId;

    /**
     * @var string
     * @Serializer\SerializedName("customer_id")
     * @Serializer\Type("string")
     */
    private $customerId;

    /**
     * @var int
     * @Serializer\SerializedName("version")
     * @Serializer\Type("integer")
     */
    private $version;

    /**
     * @var string
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var string
     * @Serializer\SerializedName("internal_tag")
     * @Serializer\Type("string")
     */
    private $internalTag;

    /**
     * @var string
     * @Serializer\SerializedName("customer_type")
     * @Serializer\Type("string")
     */
    private $customerType;

    /**
     * @var string
     * @Serializer\SerializedName("mfa_status")
     * @Serializer\Type("string")
     */
    private $mfaStatus;

    /**
     * @var string
     * @Serializer\SerializedName("kind")
     * @Serializer\Type("string")
     */
    private $kind;

    /**
     * @var string
     * @Serializer\SerializedName("pricing_mode")
     * @Serializer\Type("string")
     */
    private $pricingMode;

    /**
     * @var string
     * @Serializer\SerializedName("language")
     * @Serializer\Type("string")
     */
    private $language;

    /**
     * @var bool
     * @Serializer\SerializedName("enabled")
     * @Serializer\Type("boolean")
     */
    private $enabled;

    /**
     * @var bool
     * @Serializer\SerializedName("has_children")
     * @Serializer\Type("boolean")
     */
    private $hasChildren;

    /**
     * @var bool
     * @Serializer\SerializedName("ancestral_access")
     * @Serializer\Type("boolean")
     */
    private $ancestralAccess;

    /**
     * @var DateTimeImmutable
     * @Serializer\SerializedName("created_at")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', 'Y-m-d\TH:i:s'>")
     */
    private $createdAt;

    /**
     * @var DateTimeImmutable
     * @Serializer\SerializedName("updated_at")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', 'Y-m-d\TH:i:s'>")
     */
    private $updatedAt;

    /**
     * @var DateTimeImmutable|null
     * @Serializer\SerializedName("deleted_at")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', 'Y-m-d\TH:i:s'>")
     */
    private $deletedAt;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getParentId(): string
    {
        return $this->parentId;
    }

    /**
     * @param string $parentId
     */
    public function setParentId(string $parentId): void
    {
        $this->parentId = $parentId;
    }

    /**
     * @return string|null
     */
    public function getOwnerId(): ?string
    {
        return $this->ownerId;
    }

    /**
     * @param string|null $ownerId
     */
    public function setOwnerId(?string $ownerId): void
    {
        $this->ownerId = $ownerId;
    }

    /**
     * @return string
     */
    public function getBrandUuid(): string
    {
        return $this->brandUuid;
    }

    /**
     * @param string $brandUuid
     */
    public function setBrandUuid(string $brandUuid): void
    {
        $this->brandUuid = $brandUuid;
    }

    /**
     * @return int
     */
    public function getBrandId(): int
    {
        return $this->brandId;
    }

    /**
     * @param int $brandId
     */
    public function setBrandId(int $brandId): void
    {
        $this->brandId = $brandId;
    }

    /**
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     */
    public function setCustomerId(string $customerId): void
    {
        $this->customerId = $customerId;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @param int $version
     */
    public function setVersion(int $version): void
    {
        $this->version = $version;
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
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getInternalTag(): string
    {
        return $this->internalTag;
    }

    /**
     * @param string $internalTag
     */
    public function setInternalTag(string $internalTag): void
    {
        $this->internalTag = $internalTag;
    }

    /**
     * @return string
     */
    public function getCustomerType(): string
    {
        return $this->customerType;
    }

    /**
     * @param string $customerType
     */
    public function setCustomerType(string $customerType): void
    {
        $this->customerType = $customerType;
    }

    /**
     * @return string
     */
    public function getMfaStatus(): string
    {
        return $this->mfaStatus;
    }

    /**
     * @param string $mfaStatus
     */
    public function setMfaStatus(string $mfaStatus): void
    {
        $this->mfaStatus = $mfaStatus;
    }

    /**
     * @return string
     */
    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * @param string $kind
     */
    public function setKind(string $kind): void
    {
        $this->kind = $kind;
    }

    /**
     * @return string
     */
    public function getPricingMode(): string
    {
        return $this->pricingMode;
    }

    /**
     * @param string $pricingMode
     */
    public function setPricingMode(string $pricingMode): void
    {
        $this->pricingMode = $pricingMode;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return bool
     */
    public function isHasChildren(): bool
    {
        return $this->hasChildren;
    }

    /**
     * @param bool $hasChildren
     */
    public function setHasChildren(bool $hasChildren): void
    {
        $this->hasChildren = $hasChildren;
    }

    /**
     * @return bool
     */
    public function isAncestralAccess(): bool
    {
        return $this->ancestralAccess;
    }

    /**
     * @param bool $ancestralAccess
     */
    public function setAncestralAccess(bool $ancestralAccess): void
    {
        $this->ancestralAccess = $ancestralAccess;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable $createdAt
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTimeImmutable $updatedAt
     */
    public function setUpdatedAt(DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getDeletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTimeImmutable|null $deletedAt
     */
    public function setDeletedAt(?DateTimeImmutable $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
