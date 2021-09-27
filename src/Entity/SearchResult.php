<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use JMS\Serializer\Annotation as Serializer;

class SearchResult
{
    /**
     * @var string
     * @Serializer\SerializedName("id")
     * @Serializer\Type("string")
     */
    private $id;

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
