<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class Employee implements \JsonSerializable
{
    private string $uuid;
    private string $role;
    private \DateTimeInterface $joinedAt;
    private ?\DateTimeInterface $leftAt;
    private ?Company $company;
    private ?User $user;

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            'role' => $this->getRole(),
        ];
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getJoinedAt(): \DateTimeInterface
    {
        return $this->joinedAt;
    }

    public function setJoinedAt(\DateTimeInterface $joinedAt): static
    {
        $this->joinedAt = $joinedAt;

        return $this;
    }

    public function getLeftAt(): ?\DateTimeInterface
    {
        return $this->leftAt;
    }

    public function setLeftAt(?\DateTimeInterface $leftAt): static
    {
        $this->leftAt = $leftAt;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
