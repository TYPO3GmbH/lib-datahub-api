<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use JsonSerializable;

class Address implements JsonSerializable
{
    private string $uuid = '';

    private string $title = '';

    private string $firstName = '';

    private string $lastName = '';

    private ?string $additionalAddressLine1 = null;

    private ?string $additionalAddressLine2 = null;

    private string $street = '';

    private string $city = '';

    private string $zip = '';

    private string $country = '';

    private string $countryLabel = '';

    private string $countryIso3 = '';

    private ?string $state = null;

    private ?string $stateLabel = null;

    private ?string $companyName = null;

    private int $type = 0X000;

    private float $latitude = 0.0;

    private float $longitude = 0.0;

    public function jsonSerialize()
    {
        return [
            'title' => $this->getTitle(),
            'companyName' => $this->getCompanyName(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'additionalAddressLine1' => $this->getAdditionalAddressLine1(),
            'additionalAddressLine2' => $this->getAdditionalAddressLine2(),
            'street' => $this->getStreet(),
            'zip' => $this->getZip(),
            'city' => $this->getCity(),
            'country' => $this->getCountry(),
            'countryState' => $this->getState(),
            'type' => $this->getType(),
        ];
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getAdditionalAddressLine1(): ?string
    {
        return $this->additionalAddressLine1;
    }

    public function setAdditionalAddressLine1(?string $additionalAddressLine1): self
    {
        $this->additionalAddressLine1 = $additionalAddressLine1;
        return $this;
    }

    public function getAdditionalAddressLine2(): ?string
    {
        return $this->additionalAddressLine2;
    }

    public function setAdditionalAddressLine2(?string $additionalAddressLine2): self
    {
        $this->additionalAddressLine2 = $additionalAddressLine2;
        return $this;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;
        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function getCountryLabel(): string
    {
        return $this->countryLabel;
    }

    public function setCountryLabel(string $countryLabel): self
    {
        $this->countryLabel = $countryLabel;
        return $this;
    }

    public function getCountryIso3(): string
    {
        return $this->countryIso3;
    }

    public function setCountryIso3(string $countryIso3): self
    {
        $this->countryIso3 = $countryIso3;
        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function getStateLabel(): ?string
    {
        return $this->stateLabel;
    }

    public function setStateLabel(?string $stateLabel): self
    {
        $this->stateLabel = $stateLabel;
        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function setInvoiceAddress(bool $value): self
    {
        $value ? $this->type |= 0x0001 : $this->type &= 0x0110;

        return $this;
    }

    public function setDeliveryAddress(bool $value): self
    {
        $value ? $this->type |= 0x0100 : $this->type &= 0x0011;

        return $this;
    }

    public function setPostalAddress(bool $value): self
    {
        $value ? $this->type |= 0x0010 : $this->type &= 0x0101;

        return $this;
    }

    public function setLocationAddress(bool $value): self
    {
        $value ? $this->type |= 0x1000 : $this->type &= 0x0111;

        return $this;
    }

    public function isInvoiceAddress(): bool
    {
        return 0x0001 === ($this->type & 0x0001);
    }

    public function isDeliveryAddress(): bool
    {
        return 0x0100 === ($this->type & 0x0100);
    }

    public function isPostalAddress(): bool
    {
        return 0x0010 === ($this->type & 0x0010);
    }

    public function isLocationAddress(): bool
    {
        return 0x1000 === ($this->type & 0x1000);
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function __toString(): string
    {
        $string = $this->firstName . ' ' . $this->lastName . PHP_EOL;
        if ($this->additionalAddressLine1) {
            $string .= $this->additionalAddressLine1 . PHP_EOL;
        }
        if ($this->additionalAddressLine2) {
            $string .= $this->additionalAddressLine2 . PHP_EOL;
        }
        $string .= $this->street . PHP_EOL;
        $string .= $this->zip . ' ' . $this->city . PHP_EOL;
        $string .= $this->countryLabel;

        return $string;
    }
}
