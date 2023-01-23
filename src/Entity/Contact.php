<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class Contact
{
    /**
     * @Serializer\SerializedName("id")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private ?string $id = null;

    /**
     * @Serializer\SerializedName("aan")
     * @Serializer\Type("string")
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $acronisAccountNumber = null;

    /**
     * @var string[]
     *
     * @Serializer\SerializedName("types")
     * @Serializer\Type("array<string>")
     * @Serializer\Groups({"create_data","update_data"})
     */
    private array $types;

    /**
     * @Serializer\SerializedName("firstname")
     * @Serializer\Type("string")
     * @Serializer\Groups({"create_data","update_data"})
     */
    private string $firstname;

    /**
     * @Serializer\SerializedName("lastname")
     * @Serializer\Type("string")
     * @Serializer\Groups({"create_data","update_data"})
     */
    private string $lastname;

    /**
     * @Serializer\SerializedName("email")
     * @Serializer\Type("string")
     * @Serializer\Groups({"create_data","update_data"})
     */
    private string $email;

    /**
     * @Serializer\SerializedName("address1")
     * @Serializer\Type("string")
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $address1 = null;

    /**
     * @Serializer\SerializedName("address2")
     * @Serializer\Type("string")
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $address2 = null;

    /**
     * @Serializer\SerializedName("country")
     * @Serializer\Type("string")
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $country = null;

    /**
     * @Serializer\SerializedName("state")
     * @Serializer\Type("string")
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $state = null;

    /**
     * @Serializer\SerializedName("zipcode")
     * @Serializer\Type("string")
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $zipcode = null;

    /**
     * @Serializer\SerializedName("city")
     * @Serializer\Type("string")
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $city = null;

    /**
     * @Serializer\SerializedName("phone")
     * @Serializer\Type("string")
     * @Serializer\Groups({"create_data","update_data"})
     */
    private ?string $phone = null;

    /**
     * @Serializer\SerializedName("created_at")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', ['Y-m-d\TH:i:sP', 'Y-m-d\TH:i:s']>")
     */
    private DateTimeImmutable $createdAt;

    /**
     * @Serializer\SerializedName("updated_at")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', ['Y-m-d\TH:i:sP', 'Y-m-d\TH:i:s']>")
     */
    private DateTimeImmutable $updatedAt;

    /**
     * @param string[] $types
     */
    public function __construct(
        array $types,
        string $email,
        string $firstname,
        string $lastname
    ) {
        $this->setTypes($types)
            ->setEmail($email)
            ->setFirstname($firstname)
            ->setLastname($lastname);
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): Contact
    {
        $this->id = $id;

        return $this;
    }

    public function getAcronisAccountNumber(): ?string
    {
        return $this->acronisAccountNumber;
    }

    public function setAcronisAccountNumber(?string $acronisAccountNumber): Contact
    {
        $this->acronisAccountNumber = $acronisAccountNumber;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * @param string[] $types
     */
    public function setTypes(array $types): Contact
    {
        $this->types = $types;
        return $this;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): Contact
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): Contact
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Contact
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(?string $address1): Contact
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): Contact
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): Contact
    {
        $this->country = $country;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): Contact
    {
        $this->state = $state;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(?string $zipcode): Contact
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): Contact
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): Contact
    {
        $this->phone = $phone;

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
}
