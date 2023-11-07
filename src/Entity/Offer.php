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

    /**
     * @return $this
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    /**
     * @return array<string, mixed>
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * @param array<string, mixed> $payload
     *
     * @return $this
     */
    public function setPayload(array $payload): self
    {
        $this->payload = $payload;

        return $this;
    }

    public function getOfferNumber(): string
    {
        return $this->offerNumber;
    }

    /**
     * @return $this
     */
    public function setOfferNumber(string $offerNumber): self
    {
        $this->offerNumber = $offerNumber;

        return $this;
    }

    public function getCartIdentifier(): string
    {
        return $this->cartIdentifier;
    }

    /**
     * @return $this
     */
    public function setCartIdentifier(string $cartIdentifier): self
    {
        $this->cartIdentifier = $cartIdentifier;

        return $this;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }
}
