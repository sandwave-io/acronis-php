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

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Tenant
     */
    public function setId(string $id): Tenant
    {
        $this->id = $id;

        return $this;
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
     * @return Tenant
     */
    public function setParentId(string $parentId): Tenant
    {
        $this->parentId = $parentId;

        return $this;
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
     * @return Tenant
     */
    public function setOwnerId(?string $ownerId): Tenant
    {
        $this->ownerId = $ownerId;

        return $this;
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
     * @return Tenant
     */
    public function setBrandUuid(string $brandUuid): Tenant
    {
        $this->brandUuid = $brandUuid;

        return $this;
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
     * @return Tenant
     */
    public function setBrandId(int $brandId): Tenant
    {
        $this->brandId = $brandId;

        return $this;
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
     * @return Tenant
     */
    public function setCustomerId(string $customerId): Tenant
    {
        $this->customerId = $customerId;

        return $this;
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
     * @return Tenant
     */
    public function setVersion(int $version): Tenant
    {
        $this->version = $version;

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
     * @return Tenant
     */
    public function setName(string $name): Tenant
    {
        $this->name = $name;

        return $this;
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
     * @return Tenant
     */
    public function setInternalTag(string $internalTag): Tenant
    {
        $this->internalTag = $internalTag;

        return $this;
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
     * @return Tenant
     */
    public function setCustomerType(string $customerType): Tenant
    {
        $this->customerType = $customerType;

        return $this;
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
     * @return Tenant
     */
    public function setMfaStatus(string $mfaStatus): Tenant
    {
        $this->mfaStatus = $mfaStatus;

        return $this;
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
     * @return Tenant
     */
    public function setKind(string $kind): Tenant
    {
        $this->kind = $kind;

        return $this;
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
     * @return Tenant
     */
    public function setPricingMode(string $pricingMode): Tenant
    {
        $this->pricingMode = $pricingMode;

        return $this;
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
     * @return Tenant
     */
    public function setLanguage(string $language): Tenant
    {
        $this->language = $language;

        return $this;
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
     * @return Tenant
     */
    public function setEnabled(bool $enabled): Tenant
    {
        $this->enabled = $enabled;

        return $this;
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
     * @return Tenant
     */
    public function setHasChildren(bool $hasChildren): Tenant
    {
        $this->hasChildren = $hasChildren;

        return $this;
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
     * @return Tenant
     */
    public function setAncestralAccess(bool $ancestralAccess): Tenant
    {
        $this->ancestralAccess = $ancestralAccess;

        return $this;
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
     * @return Tenant
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): Tenant
    {
        $this->createdAt = $createdAt;

        return $this;
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
     * @return Tenant
     */
    public function setUpdatedAt(DateTimeImmutable $updatedAt): Tenant
    {
        $this->updatedAt = $updatedAt;

        return $this;
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
     * @return Tenant
     */
    public function setDeletedAt(?DateTimeImmutable $deletedAt): Tenant
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return Contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     * @return Tenant
     */
    public function setContact(Contact $contact): Tenant
    {
        $this->contact = $contact;

        return $this;
    }
}
