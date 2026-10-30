<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class License implements \JsonSerializable
{
    private string $uuid;
    private string $type;
    private string $status;
    private \DateTimeInterface $createdAt;
    private \DateTimeInterface $validUntil;
    private ?string $history = null;
    private ?string $currentJti = null;
    private ?string $subscriptionUuid = null;
    private ?string $eltsPlanUuid = null;
    private ?string $eltsRuntimeUuid = null;
    private ?string $eltsVersion = null;
    private ?string $usedFor = null;

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'status' => $this->status,
        ];
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return $this
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getValidUntil(): \DateTimeInterface
    {
        return $this->validUntil;
    }

    public function setValidUntil(\DateTimeInterface $validUntil): self
    {
        $this->validUntil = $validUntil;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(?string $history): self
    {
        $this->history = $history;

        return $this;
    }

    public function getCurrentJti(): ?string
    {
        return $this->currentJti;
    }

    public function setCurrentJti(?string $currentJti): self
    {
        $this->currentJti = $currentJti;

        return $this;
    }

    public function getSubscriptionUuid(): ?string
    {
        return $this->subscriptionUuid;
    }

    public function setSubscriptionUuid(?string $subscriptionUuid): self
    {
        $this->subscriptionUuid = $subscriptionUuid;

        return $this;
    }

    public function getEltsPlanUuid(): ?string
    {
        return $this->eltsPlanUuid;
    }

    public function setEltsPlanUuid(?string $eltsPlanUuid): self
    {
        $this->eltsPlanUuid = $eltsPlanUuid;

        return $this;
    }

    public function getEltsRuntimeUuid(): ?string
    {
        return $this->eltsRuntimeUuid;
    }

    public function setEltsRuntimeUuid(?string $eltsRuntimeUuid): self
    {
        $this->eltsRuntimeUuid = $eltsRuntimeUuid;

        return $this;
    }

    public function getEltsVersion(): ?string
    {
        return $this->eltsVersion;
    }

    public function setEltsVersion(?string $eltsVersion): self
    {
        $this->eltsVersion = $eltsVersion;

        return $this;
    }

    /**
     * Where the license is used, e.g. the domains of the instance, as entered at checkout.
     */
    public function getUsedFor(): ?string
    {
        return $this->usedFor;
    }

    public function setUsedFor(?string $usedFor): self
    {
        $this->usedFor = $usedFor;

        return $this;
    }
}
