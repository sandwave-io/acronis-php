<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class Tenant
{
    /**
     * @Serializer\SerializedName("id")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"update_data"})
     */
    private ?string $id = null;

    /**
     * @Serializer\SerializedName("parent_id")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private string $parentId;

    /**
     * @Serializer\SerializedName("owner_id")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $ownerId = null;

    /**
     * @Serializer\SerializedName("brand_uuid")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $brandUuid = null;

    /**
     * @Serializer\SerializedName("brand_id")
     *
     * @Serializer\Type("integer")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?int $brandId = null;

    /**
     * @Serializer\SerializedName("customer_id")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $customerId = null;

    /**
     * @Serializer\SerializedName("version")
     *
     * @Serializer\Type("integer")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?int $version = null;

    /**
     * @Serializer\SerializedName("name")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private string $name;

    /**
     * @Serializer\SerializedName("internal_tag")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $internalTag = null;

    /**
     * @Serializer\SerializedName("customer_type")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups()
     */
    private ?string $customerType = null;

    /**
     * @Serializer\SerializedName("mfa_status")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $mfaStatus = null;

    /**
     * @Serializer\SerializedName("kind")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private string $kind;

    /**
     * @Serializer\SerializedName("pricing_mode")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $pricingMode = null;

    /**
     * @Serializer\SerializedName("language")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $language = null;

    /**
     * @Serializer\SerializedName("enabled")
     *
     * @Serializer\Type("boolean")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private bool $enabled = false;

    /**
     * @Serializer\SerializedName("has_children")
     *
     * @Serializer\Type("boolean")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private bool $hasChildren = false;

    /**
     * @Serializer\SerializedName("ancestral_access")
     *
     * @Serializer\Type("boolean")
     *
     * @Serializer\Groups()
     */
    private bool $ancestralAccess;

    /**
     * @Serializer\SerializedName("created_at")
     *
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', ['Y-m-d\TH:i:s\Z', 'Y-m-d\TH:i:s']>")
     */
    private DateTimeImmutable $createdAt;

    /**
     * @Serializer\SerializedName("updated_at")
     *
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', ['Y-m-d\TH:i:s\Z', 'Y-m-d\TH:i:s']>")
     */
    private DateTimeImmutable $updatedAt;

    /**
     * @Serializer\SerializedName("deleted_at")
     *
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', ['Y-m-d\TH:i:s\Z', 'Y-m-d\TH:i:s']>")
     */
    private ?DateTimeImmutable $deletedAt = null;

    /**
     * @Serializer\SerializedName("contact")
     *
     * @Serializer\Type("SandwaveIo\Acronis\Entity\Contact")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?Contact $contact = null;

    public function __construct(
        string $parentId,
        string $name,
        string $kind
    ) {
        $this->setParentId($parentId)
            ->setName($name)
            ->setKind($kind);
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

    public function getBrandUuid(): ?string
    {
        return $this->brandUuid;
    }

    public function setBrandUuid(?string $brandUuid): Tenant
    {
        $this->brandUuid = $brandUuid;

        return $this;
    }

    public function getBrandId(): ?int
    {
        return $this->brandId;
    }

    public function setBrandId(?int $brandId): Tenant
    {
        $this->brandId = $brandId;

        return $this;
    }

    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }

    public function setCustomerId(?string $customerId): Tenant
    {
        $this->customerId = $customerId;

        return $this;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(?int $version): Tenant
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

    public function getInternalTag(): ?string
    {
        return $this->internalTag;
    }

    public function setInternalTag(?string $internalTag): Tenant
    {
        $this->internalTag = $internalTag;

        return $this;
    }

    public function getCustomerType(): ?string
    {
        return $this->customerType;
    }

    public function setCustomerType(?string $customerType): Tenant
    {
        $this->customerType = $customerType;

        return $this;
    }

    public function getMfaStatus(): ?string
    {
        return $this->mfaStatus;
    }

    public function setMfaStatus(?string $mfaStatus): Tenant
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

    public function getPricingMode(): ?string
    {
        return $this->pricingMode;
    }

    public function setPricingMode(?string $pricingMode): Tenant
    {
        $this->pricingMode = $pricingMode;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): Tenant
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

    public function hasChildren(): bool
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

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): Tenant
    {
        $this->contact = $contact;

        return $this;
    }
}
