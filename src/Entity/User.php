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

    /**
     * User constructor.
     *
     * @param string|null       $id
     * @param string|null       $tenantId
     * @param string|null       $personalTenantId
     * @param int               $version
     * @param string            $login
     * @param bool              $enabled
     * @param bool              $activated
     * @param string            $language
     * @param string            $mfaStatus
     * @param DateTimeImmutable $createdAt
     * @param DateTimeImmutable $updatedAt
     * @param Contact           $contact
     */
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

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     *
     * @return User
     */
    public function setId(?string $id): User
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTenantId(): ?string
    {
        return $this->tenantId;
    }

    /**
     * @param string|null $tenantId
     *
     * @return User
     */
    public function setTenantId(?string $tenantId): User
    {
        $this->tenantId = $tenantId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPersonalTenantId(): ?string
    {
        return $this->personalTenantId;
    }

    /**
     * @param string|null $personalTenantId
     *
     * @return User
     */
    public function setPersonalTenantId(?string $personalTenantId): User
    {
        $this->personalTenantId = $personalTenantId;

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
     *
     * @return User
     */
    public function setVersion(int $version): User
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     *
     * @return User
     */
    public function setLogin(string $login): User
    {
        $this->login = $login;

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
     *
     * @return User
     */
    public function setEnabled(bool $enabled): User
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActivated(): bool
    {
        return $this->activated;
    }

    /**
     * @param bool $activated
     *
     * @return User
     */
    public function setActivated(bool $activated): User
    {
        $this->activated = $activated;

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
     *
     * @return User
     */
    public function setLanguage(string $language): User
    {
        $this->language = $language;

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
     *
     * @return User
     */
    public function setMfaStatus(string $mfaStatus): User
    {
        $this->mfaStatus = $mfaStatus;

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
     *
     * @return User
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): User
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
     *
     * @return User
     */
    public function setUpdatedAt(DateTimeImmutable $updatedAt): User
    {
        $this->updatedAt = $updatedAt;

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
     *
     * @return User
     */
    public function setContact(Contact $contact): User
    {
        $this->contact = $contact;

        return $this;
    }
}
