<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class User
{
    /**
     * @var string|null
     * @Serializer\SerializedName("id")
     * @Serializer\Type("string")
     */
    private $id;

    /**
     * @var string|null
     * @Serializer\SerializedName("tenant_id")
     * @Serializer\Type("string")
     */
    private $tenantId;

    /**
     * @var string|null
     * @Serializer\SerializedName("personal_tenant_id")
     * @Serializer\Type("string")
     */
    private $personalTenantId;

    /**
     * @var int
     * @Serializer\SerializedName("version")
     * @Serializer\Type("integer")
     * @Serializer\Groups({"update_data"})
     */
    private $version;

    /**
     * @var string
     * @Serializer\SerializedName("login")
     * @Serializer\Type("string")
     */
    private $login;

    /**
     * @var bool
     * @Serializer\SerializedName("enabled")
     * @Serializer\Type("boolean")
     */
    private $enabled;

    /**
     * @var bool
     * @Serializer\SerializedName("activated")
     * @Serializer\Type("boolean")
     */
    private $activated;

    /**
     * @var string
     * @Serializer\SerializedName("language")
     * @Serializer\Type("string")
     */
    private $language;

    /**
     * @var string
     * @Serializer\SerializedName("mfa_status")
     * @Serializer\Type("string")
     */
    private $mfaStatus;

    /**
     * @var DateTimeImmutable
     * @Serializer\SerializedName("created_at")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', ['Y-m-d\TH:i:s\Z', 'Y-m-d\TH:i:s']>")
     */
    private $createdAt;

    /**
     * @var DateTimeImmutable
     * @Serializer\SerializedName("updated_at")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', ['Y-m-d\TH:i:s\Z', 'Y-m-d\TH:i:s']>")
     */
    private $updatedAt;

    /**
     * @var Contact
     * @Serializer\SerializedName("contact")
     * @Serializer\Type("SandwaveIo\Acronis\Entity\Contact")
     * @Serializer\Groups({"update_data"})
     */
    private $contact;

    public function __construct(
        ?string $id,
        ?string $tenantId,
        ?string $personalTenantId,
        int $version,
        string $login,
        bool $enabled,
        bool $activated,
        string $language,
        string $mfaStatus,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        Contact $contact
    ) {
        $this->id = $id;
        $this->tenantId = $tenantId;
        $this->personalTenantId = $personalTenantId;
        $this->version = $version;
        $this->login = $login;
        $this->enabled = $enabled;
        $this->activated = $activated;
        $this->language = $language;
        $this->mfaStatus = $mfaStatus;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->contact = $contact;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): User
    {
        $this->id = $id;

        return $this;
    }

    public function getTenantId(): ?string
    {
        return $this->tenantId;
    }

    public function setTenantId(?string $tenantId): User
    {
        $this->tenantId = $tenantId;

        return $this;
    }

    public function getPersonalTenantId(): ?string
    {
        return $this->personalTenantId;
    }

    public function setPersonalTenantId(?string $personalTenantId): User
    {
        $this->personalTenantId = $personalTenantId;

        return $this;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): User
    {
        $this->version = $version;

        return $this;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): User
    {
        $this->login = $login;

        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): User
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function isActivated(): bool
    {
        return $this->activated;
    }

    public function setActivated(bool $activated): User
    {
        $this->activated = $activated;

        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): User
    {
        $this->language = $language;

        return $this;
    }

    public function getMfaStatus(): string
    {
        return $this->mfaStatus;
    }

    public function setMfaStatus(string $mfaStatus): User
    {
        $this->mfaStatus = $mfaStatus;

        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): User
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): User
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }

    public function setContact(Contact $contact): User
    {
        $this->contact = $contact;

        return $this;
    }
}
