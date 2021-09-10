<?php

declare(strict_types = 1);

namespace SandwaveIo\Acronis\Entity;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

class Contact
{
    /**
     * @var string|null
     * @Serializer\SerializedName("id")
     * @Serializer\Type("string")
     */
    private $id;

    /**
     * @var int
     * @Serializer\SerializedName("aan")
     * @Serializer\Type("int")
     */
    private $acronisAccountNumber;

    /**
     * @var string
     * @Serializer\SerializedName("firstname")
     * @Serializer\Type("string")
     */
    private $firstname;

    /**
     * @var string
     * @Serializer\SerializedName("lastname")
     * @Serializer\Type("string")
     */
    private $lastname;

    /**
     * @var string
     * @Serializer\SerializedName("email")
     * @Serializer\Type("string")
     * @Serializer\Groups({"update_data"})
     */
    private $email;

    /**
     * @var string
     * @Serializer\SerializedName("address1")
     * @Serializer\Type("string")
     */
    private $address1;

    /**
     * @var string
     * @Serializer\SerializedName("address2")
     * @Serializer\Type("string")
     */
    private $address2;

    /**
     * @var string
     * @Serializer\SerializedName("country")
     * @Serializer\Type("string")
     */
    private $country;

    /**
     * @var string
     * @Serializer\SerializedName("state")
     * @Serializer\Type("string")
     */
    private $state;

    /**
     * @var string
     * @Serializer\SerializedName("zipcode")
     * @Serializer\Type("string")
     */
    private $zipcode;

    /**
     * @var string
     * @Serializer\SerializedName("city")
     * @Serializer\Type("string")
     */
    private $city;

    /**
     * @var string
     * @Serializer\SerializedName("phone")
     * @Serializer\Type("string")
     */
    private $phone;

    /**
     * @var DateTimeImmutable
     * @Serializer\SerializedName("created_at")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', ['Y-m-d\TH:i:sP', 'Y-m-d\TH:i:s']>")
     */
    private $createdAt;

    /**
     * @var DateTimeImmutable
     * @Serializer\SerializedName("updated_at")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d H:i:s', '', ['Y-m-d\TH:i:sP', 'Y-m-d\TH:i:s']>")
     */
    private $updatedAt;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): Contact
    {
        $this->id = $id;

        return $this;
    }

    public function getAcronisAccountNumber(): int
    {
        return $this->acronisAccountNumber;
    }

    public function setAcronisAccountNumber(int $acronisAccountNumber): Contact
    {
        $this->acronisAccountNumber = $acronisAccountNumber;

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

    public function getAddress1(): string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): Contact
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): string
    {
        return $this->address2;
    }

    public function setAddress2(string $address2): Contact
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): Contact
    {
        $this->country = $country;

        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): Contact
    {
        $this->state = $state;

        return $this;
    }

    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): Contact
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): Contact
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): Contact
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): Contact
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): Contact
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
