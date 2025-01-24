<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class Order implements \JsonSerializable
{
    private string $uuid;
    private string $orderNumber;
    private array $payload;
    private \DateTimeInterface $createdAt;
    private ?User $user = null;
    private ?Company $company = null;

    /**
     * @var Invoice[]
     */
    private array $invoices = [];

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'orderNumber' => $this->getOrderNumber(),
            'payload' => $this->getPayload(),
            'user' => null !== $this->user ? $this->user->jsonSerialize() : null,
            'company' => null !== $this->company ? $this->company->jsonSerialize() : null,
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

    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }

    /**
     * @return $this
     */
    public function setOrderNumber(string $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * @return $this
     */
    public function setPayload(array $payload): self
    {
        $this->payload = $payload;

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

    public function getInvoices(): array
    {
        return $this->invoices;
    }

    public function getInvoicesOrderedByDate(): array
    {
        $sorted = $this->invoices;
        usort($sorted, static function (Invoice $a, Invoice $b) {
            return $a->getDate() <=> $b->getDate();
        });

        return $sorted;
    }

    /**
     * @return $this
     */
    public function addInvoice(Invoice $invoice): self
    {
        $this->invoices[] = $invoice;

        return $this;
    }

    /**
     * @return $this
     */
    public function removeInvoice(Invoice $invoice): self
    {
        $this->invoices = array_filter($this->invoices, static function (Invoice $i) use ($invoice) {
            return $i->getLink() !== $invoice->getLink();
        });

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): Order
    {
        $this->user = $user;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): Order
    {
        $this->company = $company;

        return $this;
    }
}
