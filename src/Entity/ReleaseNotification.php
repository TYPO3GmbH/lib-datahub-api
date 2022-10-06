<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use JsonSerializable;

class ReleaseNotification implements JsonSerializable
{
    private string $uuid;
    private string $name;
    private string $email;
    private bool $accepted = false;
    private bool $inherited = false;
    private ?EltsPlan $eltsPlan = null;
    private ?EltsInstance $eltsInstance = null;

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getAccepted(): bool
    {
        return $this->accepted;
    }

    public function setAccepted(bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }

    public function getInherited(): bool
    {
        return $this->inherited;
    }

    public function setInherited(bool $inherited): self
    {
        $this->inherited = $inherited;

        return $this;
    }

    public function getEltsPlan(): ?EltsPlan
    {
        return $this->eltsPlan;
    }

    public function setEltsPlan(?EltsPlan $eltsPlan): self
    {
        $this->eltsPlan = $eltsPlan;

        return $this;
    }

    public function getEltsInstance(): ?EltsInstance
    {
        return $this->eltsInstance;
    }

    public function setEltsInstance(?EltsInstance $eltsInstance): self
    {
        $this->eltsInstance = $eltsInstance;

        return $this;
    }
}
