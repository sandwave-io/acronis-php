<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class Tenant
{
    /**
     * @var string|null
     * @Serializer\SerializedName("id")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
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
     * @Serializer\Groups({"update_data"})
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
     * @Serializer\Groups({"update_data"})
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
     * @var Contact
     * @Serializer\SerializedName("contact")
     * @Serializer\Type("SandwaveIo\Acronis\Entity\Contact")
     */
    private $contact;

    public function __construct(
        int $version,
        string $parentId,
        string $brandUuid,
        int $brandId,
        string $customerId,
        string $name,
        string $internalTag,
        string $customerType,
        string $mfaStatus,
        string $kind,
        string $pricingMode,
        string $language,
        bool $enabled,
        bool $hasChildren,
        bool $ancestralAccess,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        Contact $contact,
        string $id = null,
        ?string $ownerId = null,
        ?DateTimeImmutable $deletedAt = null
    ) {
        $this->id = $id;
        $this->version = $version;
        $this->parentId = $parentId;
        $this->brandUuid = $brandUuid;
        $this->brandId = $brandId;
        $this->customerId = $customerId;
        $this->name = $name;
        $this->internalTag = $internalTag;
        $this->customerType = $customerType;
        $this->mfaStatus = $mfaStatus;
        $this->kind = $kind;
        $this->pricingMode = $pricingMode;
        $this->language = $language;
        $this->enabled = $enabled;
        $this->hasChildren = $hasChildren;
        $this->ancestralAccess = $ancestralAccess;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->contact = $contact;
        $this->ownerId = $ownerId;
        $this->deletedAt = $deletedAt;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): Tenant
    {
        $this->id = $id;

        return $this;
    }

    public function getParentId(): string
    {
        return $this->parentId;
    }

    public function setParentId(string $parentId): Tenant
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function getOwnerId(): ?string
    {
        return $this->ownerId;
    }

    public function setOwnerId(?string $ownerId): Tenant
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    public function getBrandUuid(): string
    {
        return $this->brandUuid;
    }

    public function setBrandUuid(string $brandUuid): Tenant
    {
        $this->brandUuid = $brandUuid;

        return $this;
    }

    public function getBrandId(): int
    {
        return $this->brandId;
    }

    public function setBrandId(int $brandId): Tenant
    {
        $this->brandId = $brandId;

        return $this;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function setCustomerId(string $customerId): Tenant
    {
        $this->customerId = $customerId;

        return $this;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): Tenant
    {
        $this->version = $version;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Tenant
    {
        $this->name = $name;

        return $this;
    }

    public function getInternalTag(): string
    {
        return $this->internalTag;
    }

    public function setInternalTag(string $internalTag): Tenant
    {
        $this->internalTag = $internalTag;

        return $this;
    }

    public function getCustomerType(): string
    {
        return $this->customerType;
    }

    public function setCustomerType(string $customerType): Tenant
    {
        $this->customerType = $customerType;

        return $this;
    }

    public function getMfaStatus(): string
    {
        return $this->mfaStatus;
    }

    public function setMfaStatus(string $mfaStatus): Tenant
    {
        $this->mfaStatus = $mfaStatus;

        return $this;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): Tenant
    {
        $this->kind = $kind;

        return $this;
    }

    public function getPricingMode(): string
    {
        return $this->pricingMode;
    }

    public function setPricingMode(string $pricingMode): Tenant
    {
        $this->pricingMode = $pricingMode;

        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): Tenant
    {
        $this->language = $language;

        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): Tenant
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function isHasChildren(): bool
    {
        return $this->hasChildren;
    }

    public function setHasChildren(bool $hasChildren): Tenant
    {
        $this->hasChildren = $hasChildren;

        return $this;
    }

    public function isAncestralAccess(): bool
    {
        return $this->ancestralAccess;
    }

    public function setAncestralAccess(bool $ancestralAccess): Tenant
    {
        $this->ancestralAccess = $ancestralAccess;

        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): Tenant
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): Tenant
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?DateTimeImmutable $deletedAt): Tenant
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }

    public function setContact(Contact $contact): Tenant
    {
        $this->contact = $contact;

        return $this;
    }
}
