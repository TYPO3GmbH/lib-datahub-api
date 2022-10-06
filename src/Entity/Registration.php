<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use DateTimeInterface;
use JsonSerializable;

class Registration implements JsonSerializable
{
    private string $username;
    private string $email;
    private string $firstName;
    private string $lastName;
    private ?string $password = null;
    private ?string $location = null;
    private ?string $registrationCode = null;
    private ?DateTimeInterface $validUntil = null;

    /**
     * @var array<string, string>
     */
    private array $approvedDocuments = [];

    public function jsonSerialize()
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'password' => $this->password,
            'location' => $this->location,
            'approvedDocuments' => $this->approvedDocuments,
        ];
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRegistrationCode(): ?string
    {
        return $this->registrationCode;
    }

    public function setRegistrationCode(?string $registrationCode): self
    {
        $this->registrationCode = $registrationCode;

        return $this;
    }

    public function getValidUntil(): ?DateTimeInterface
    {
        return $this->validUntil;
    }

    public function setValidUntil(?DateTimeInterface $validUntil): self
    {
        $this->validUntil = $validUntil;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function addApprovedDocument(string $identifier, string $version): self
    {
        $this->approvedDocuments[$identifier] = $version;

        return $this;
    }

    /**
     * @return array<string, string>
     */
    public function getApprovedDocuments(): array
    {
        return $this->approvedDocuments;
    }
}
