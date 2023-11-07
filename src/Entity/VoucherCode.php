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

    /**
     * @return $this
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * @return $this
     */
    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getVoucherCode(): string
    {
        return $this->voucherCode;
    }

    /**
     * @return $this
     */
    public function setVoucherCode(string $voucherCode): self
    {
        $this->voucherCode = $voucherCode;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getExpiresAt(): \DateTimeInterface
    {
        return $this->expiresAt;
    }

    /**
     * @return $this
     */
    public function setExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    /**
     * @return $this
     */
    public function setOrderNumber(?string $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getProduct(): ?string
    {
        return $this->product;
    }

    /**
     * @return $this
     */
    public function setProduct(?string $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return $this
     */
    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUsages(): ?int
    {
        return $this->usages;
    }

    /**
     * @return $this
     */
    public function setUsages(?int $usages): self
    {
        $this->usages = $usages;

        return $this;
    }

    public function getRedemptions(): int
    {
        return $this->redemptions;
    }

    /**
     * @return $this
     */
    public function setRedemptions(int $redemptions): self
    {
        $this->redemptions = $redemptions;

        return $this;
    }

    public function getIsExpired(): bool
    {
        return $this->isExpired;
    }

    /**
     * @return $this
     */
    public function setIsExpired(bool $isExpired): self
    {
        $this->isExpired = $isExpired;

        return $this;
    }

    public function getIsUsed(): bool
    {
        return $this->isUsed;
    }

    /**
     * @return $this
     */
    public function setIsUsed(bool $isUsed): self
    {
        $this->isUsed = $isUsed;

        return $this;
    }

    public function getIsRedeemable(): bool
    {
        return $this->isRedeemable;
    }

    /**
     * @return $this
     */
    public function setIsRedeemable(bool $isRedeemable): self
    {
        $this->isRedeemable = $isRedeemable;

        return $this;
    }
}
