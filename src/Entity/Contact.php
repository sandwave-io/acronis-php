<?php

declare(strict_types=1);

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

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return Contact
     */
    public function setId(?string $id): Contact
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getAcronisAccountNumber(): int
    {
        return $this->acronisAccountNumber;
    }

    /**
     * @param int $acronisAccountNumber
     * @return Contact
     */
    public function setAcronisAccountNumber(int $acronisAccountNumber): Contact
    {
        $this->acronisAccountNumber = $acronisAccountNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return Contact
     */
    public function setFirstname(string $firstname): Contact
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return Contact
     */
    public function setLastname(string $lastname): Contact
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Contact
     */
    public function setEmail(string $email): Contact
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     * @return Contact
     */
    public function setAddress1(string $address1): Contact
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     * @return Contact
     */
    public function setAddress2(string $address2): Contact
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Contact
     */
    public function setCountry(string $country): Contact
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Contact
     */
    public function setState(string $state): Contact
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     * @return Contact
     */
    public function setZipcode(string $zipcode): Contact
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Contact
     */
    public function setCity(string $city): Contact
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Contact
     */
    public function setPhone(string $phone): Contact
    {
        $this->phone = $phone;

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
     * @return Contact
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): Contact
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
     * @return Contact
     */
    public function setUpdatedAt(DateTimeImmutable $updatedAt): Contact
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


}
