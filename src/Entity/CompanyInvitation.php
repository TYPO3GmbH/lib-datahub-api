<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class CompanyInvitation
{
    private string $username;
    private string $email;
    private string $inviteCode;
    private \DateTimeInterface $validUntil;
    private string $role;

    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getInviteCode(): string
    {
        return $this->inviteCode;
    }

    /**
     * @return $this
     */
    public function setInviteCode(string $inviteCode): self
    {
        $this->inviteCode = $inviteCode;

        return $this;
    }

    public function getValidUntil(): \DateTimeInterface
    {
        return $this->validUntil;
    }

    /**
     * @return $this
     */
    public function setValidUntil(\DateTimeInterface $validUntil): self
    {
        $this->validUntil = $validUntil;

        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return $this
     */
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
}
