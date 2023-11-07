<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class Offer
{
    private string $uuid;
    private \DateTimeInterface $createdAt;
    private \DateTimeInterface $validUntil;

    /**
     * @var array<string, mixed>
     */
    private array $payload;
    private string $offerNumber;
    private string $cartIdentifier;
    private float $total;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getValidUntil(): \DateTimeInterface
    {
        return $this->validUntil;
    }

    public function setValidUntil(\DateTimeInterface $validUntil): static
    {
        $this->validUntil = $validUntil;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * @param array<string, mixed> $payload
     */
    public function setPayload(array $payload): static
    {
        $this->payload = $payload;

        return $this;
    }

    public function getOfferNumber(): string
    {
        return $this->offerNumber;
    }

    public function setOfferNumber(string $offerNumber): static
    {
        $this->offerNumber = $offerNumber;

        return $this;
    }

    public function getCartIdentifier(): string
    {
        return $this->cartIdentifier;
    }

    public function setCartIdentifier(string $cartIdentifier): static
    {
        $this->cartIdentifier = $cartIdentifier;

        return $this;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }
}
