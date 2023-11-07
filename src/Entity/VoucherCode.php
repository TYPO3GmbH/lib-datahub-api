<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use T3G\DatahubApiLibrary\Enum\VoucherCodeStatus;
use T3G\DatahubApiLibrary\Enum\VoucherCodeType;

class VoucherCode implements \JsonSerializable
{
    private string $uuid;
    private ?User $user = null;
    private ?Company $company = null;
    private string $title;
    private string $description;
    private string $voucherCode;
    private string $type = VoucherCodeType::EVENTS;
    private string $status = VoucherCodeStatus::NEW;
    private \DateTimeInterface $expiresAt;
    private ?string $orderNumber = null;
    private ?string $product = null;
    private ?string $username = null;
    private ?int $usages = 1;
    private int $redemptions = 0;
    private bool $isExpired = false;
    private bool $isUsed = false;
    private bool $isRedeemable = false;

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'type' => $this->getType(),
            'status' => $this->getStatus(),
            'expiresAt' => $this->getExpiresAt()->format(\DateTimeInterface::ATOM),
            'orderNumber' => $this->getOrderNumber(),
            'product' => $this->getProduct(),
            'username' => $this->getUsername(),
            'usages' => $this->getUsages(),
            'redemptions' => $this->getRedemptions(),
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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

    public function getVoucherCode(): string
    {
        return $this->voucherCode;
    }

    public function setVoucherCode(string $voucherCode): static
    {
        $this->voucherCode = $voucherCode;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getExpiresAt(): \DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(\DateTimeInterface $expiresAt): static
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(?string $orderNumber): static
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getProduct(): ?string
    {
        return $this->product;
    }

    public function setProduct(?string $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getUsages(): ?int
    {
        return $this->usages;
    }

    public function setUsages(?int $usages): static
    {
        $this->usages = $usages;

        return $this;
    }

    public function getRedemptions(): int
    {
        return $this->redemptions;
    }

    public function setRedemptions(int $redemptions): static
    {
        $this->redemptions = $redemptions;

        return $this;
    }

    public function getIsExpired(): bool
    {
        return $this->isExpired;
    }

    public function setIsExpired(bool $isExpired): static
    {
        $this->isExpired = $isExpired;

        return $this;
    }

    public function getIsUsed(): bool
    {
        return $this->isUsed;
    }

    public function setIsUsed(bool $isUsed): static
    {
        $this->isUsed = $isUsed;

        return $this;
    }

    public function getIsRedeemable(): bool
    {
        return $this->isRedeemable;
    }

    public function setIsRedeemable(bool $isRedeemable): static
    {
        $this->isRedeemable = $isRedeemable;

        return $this;
    }
}
