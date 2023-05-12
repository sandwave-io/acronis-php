<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use JMS\Serializer\Annotation as Serializer;

class SearchResult
{
    /**
     * @Serializer\SerializedName("id")
     * @Serializer\Type("string")
     */
    private string $id;

    /**
     * @Serializer\SerializedName("obj_type")
     * @Serializer\Type("string")
     */
    private string $type;

    /**
     * @Serializer\SerializedName("kind")
     * @Serializer\Type("string")
     */
    private string $kind;

    /**
     * @Serializer\SerializedName("parent_id")
     * @Serializer\Type("string")
     */
    private string $parentId;

    /**
     * @var string[]
     *
     * @Serializer\SerializedName("path")
     * @Serializer\Type("array<string>")
     */
    private array $path;

    /**
     * @Serializer\SerializedName("name")
     * @Serializer\Type("string")
     */
    private string $name;

    /**
     * @Serializer\SerializedName("first_name")
     * @Serializer\Type("string")
     */
    private ?string $firstname = null;

    /**
     * @Serializer\SerializedName("last_name")
     * @Serializer\Type("string")
     */
    private ?string $lastname = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function getParentId(): string
    {
        return $this->parentId;
    }

    /**
     * @return string[]
     */
    public function getPath(): array
    {
        return $this->path;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }
}
