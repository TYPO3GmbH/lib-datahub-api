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

    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(string $orderNumber): static
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function setPayload(array $payload): static
    {
        $this->payload = $payload;

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

    public function addInvoice(Invoice $invoice): static
    {
        $this->invoices[] = $invoice;

        return $this;
    }

    public function removeInvoice(Invoice $invoice): static
    {
        $this->invoices = array_filter($this->invoices, static function (Invoice $i) use ($invoice) {
            return $i->getLink() !== $invoice->getLink();
        });

        return $this;
    }
}
