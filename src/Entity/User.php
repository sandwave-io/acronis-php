<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class User
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
     * @Serializer\SerializedName("tenant_id")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private string $tenantId;

    /**
     * @Serializer\SerializedName("personal_tenant_id")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"update_data"})
     */
    private ?string $personalTenantId;

    /**
     * @Serializer\SerializedName("version")
     *
     * @Serializer\Type("integer")
     *
     * @Serializer\Groups({"update_data"})
     */
    private ?int $version;

    /**
     * @Serializer\SerializedName("login")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $login;

    /**
     * @Serializer\SerializedName("enabled")
     *
     * @Serializer\Type("boolean")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?bool $enabled;

    /**
     * @Serializer\SerializedName("activated")
     *
     * @Serializer\Type("boolean")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?bool $activated;

    /**
     * @Serializer\SerializedName("language")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $language;

    /**
     * @Serializer\SerializedName("mfa_status")
     *
     * @Serializer\Type("string")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $mfaStatus;

    /**
     * @Serializer\SerializedName("created_at")
     *
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', ['Y-m-d\TH:i:s\Z', 'Y-m-d\TH:i:s']>")
     */
    private ?DateTimeImmutable $createdAt;

    /**
     * @Serializer\SerializedName("updated_at")
     *
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', ['Y-m-d\TH:i:s\Z', 'Y-m-d\TH:i:s']>")
     */
    private ?DateTimeImmutable $updatedAt;

    /**
     * @Serializer\SerializedName("contact")
     *
     * @Serializer\Type("SandwaveIo\Acronis\Entity\Contact")
     *
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?Contact $contact;

    public function __construct(
        string $tenantId
    ) {
        $this->setTenantId($tenantId);
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

    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    public function setTenantId(string $tenantId): User
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

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(?int $version): User
    {
        $this->version = $version;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): User
    {
        $this->login = $login;

        return $this;
    }

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(?bool $enabled): User
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function isActivated(): ?bool
    {
        return $this->activated;
    }

    public function setActivated(?bool $activated): User
    {
        $this->activated = $activated;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): User
    {
        $this->language = $language;

        return $this;
    }

    public function getMfaStatus(): ?string
    {
        return $this->mfaStatus;
    }

    public function setMfaStatus(?string $mfaStatus): User
    {
        $this->mfaStatus = $mfaStatus;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): User
    {
        $this->contact = $contact;

        return $this;
    }
}
