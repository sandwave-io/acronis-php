<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class SearchResult
{
    /**
     * @var string
     * @Serializer\SerializedName("obj_type")
     * @Serializer\Type("string")
     */
    private $type;

    /**
     * @var string
     * @Serializer\SerializedName("kind")
     * @Serializer\Type("string")
     */
    private $kind;

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
     * @var string[]
     * @Serializer\SerializedName("path")
     * @Serializer\Type("array<string>")
     */
    private $path;

    /**
     * @var string
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var string|null
     * @Serializer\SerializedName("first_name")
     * @Serializer\Type("string")
     */
    private $firstname;

    /**
     * @var string|null
     * @Serializer\SerializedName("last_name")
     * @Serializer\Type("string")
     */
    private $lastname;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Tenant
     */
    public function setType(string $type): Tenant
    {
        $this->type = $type;
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
     * @return string[]
     */
    public function getPath(): array
    {
        return $this->path;
    }

    /**
     * @param string[] $path
     * @return Tenant
     */
    public function setPath(array $path): Tenant
    {
        $this->path = $path;
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
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     * @return Tenant
     */
    public function setFirstname(?string $firstname): Tenant
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     * @return Tenant
     */
    public function setLastname(?string $lastname): Tenant
    {
        $this->lastname = $lastname;
        return $this;
    }
}
