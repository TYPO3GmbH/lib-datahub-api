<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use T3G\DatahubApiLibrary\Enum\CompanyType;
use T3G\DatahubApiLibrary\Enum\MembershipType;
use T3G\DatahubApiLibrary\Enum\SubscriptionStatus;
use T3G\DatahubApiLibrary\Enum\SubscriptionType;

class Subscription implements \JsonSerializable
{
    private string $uuid = '';
    private string $subscriptionIdentifier = '';
    private string $subscriptionStatus = '';
    private string $subscriptionType = '';
    private string $subscriptionSubType = '';
    private string $stripeLink = '';
    private ?\DateTimeInterface $validUntil = null;
    private \DateTimeInterface $cancellationDeadline;
    private ?array $payload = null;
    private ?string $history = null;
    private ?User $user = null;
    private ?Company $company = null;
    private ?string $paymentStatus = null;

    /**
     * @var array{category: string, isActive?: bool, isPaid?: bool}
     */
    private array $status = [];

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'subscriptionIdentifier' => $this->getSubscriptionIdentifier(),
            'subscriptionStatus' => $this->getSubscriptionStatus(),
            'subscriptionType' => $this->getSubscriptionType(),
            'subscriptionSubType' => $this->getSubscriptionSubType(),
            'stripeLink' => $this->getStripeLink(),
            'validUntil' => null !== $this->getValidUntil() ? $this->getValidUntil()->format(\DateTimeInterface::ATOM) : null,
            'payload' => $this->getPayload(),
            'paymentStatus' => $this->getPaymentStatus(),
            'status' => $this->getStatus(),
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

    public function getSubscriptionIdentifier(): string
    {
        return $this->subscriptionIdentifier;
    }

    /**
     * @return $this
     */
    public function setSubscriptionIdentifier(string $subscriptionIdentifier): self
    {
        $this->subscriptionIdentifier = $subscriptionIdentifier;

        return $this;
    }

    public function getSubscriptionStatus(): string
    {
        return $this->subscriptionStatus;
    }

    /**
     * @return $this
     */
    public function setSubscriptionStatus(string $subscriptionStatus): self
    {
        $this->subscriptionStatus = $subscriptionStatus;

        return $this;
    }

    public function getSubscriptionType(): string
    {
        return $this->subscriptionType;
    }

    /**
     * @return $this
     */
    public function setSubscriptionType(string $subscriptionType): self
    {
        $this->subscriptionType = $subscriptionType;

        return $this;
    }

    public function getStripeLink(): string
    {
        return $this->stripeLink;
    }

    /**
     * @return $this
     */
    public function setStripeLink(string $stripeLink): self
    {
        $this->stripeLink = $stripeLink;

        return $this;
    }

    public function getSubscriptionSubType(): string
    {
        return $this->subscriptionSubType;
    }

    /**
     * @return $this
     */
    public function setSubscriptionSubType(string $subscriptionSubType): self
    {
        $allowedSubTypes = SubscriptionType::getAllowedSubTypes($this->getSubscriptionType());
        if (null === $allowedSubTypes || !in_array($subscriptionSubType, $allowedSubTypes, true)) {
            throw new \InvalidArgumentException('Invalid subscription sub type "' . $subscriptionSubType . '"');
        }
        $this->subscriptionSubType = $subscriptionSubType;

        return $this;
    }

    public function getValidUntil(): ?\DateTimeInterface
    {
        return $this->validUntil;
    }

    /**
     * @return $this
     */
    public function setValidUntil(?\DateTimeInterface $validUntil): self
    {
        $this->validUntil = $validUntil;

        return $this;
    }

    public function getCancellationDeadline(): \DateTimeInterface
    {
        return $this->cancellationDeadline;
    }

    /**
     * @return $this
     */
    public function setCancellationDeadline(\DateTimeInterface $cancellationDeadline): self
    {
        $this->cancellationDeadline = $cancellationDeadline;

        return $this;
    }

    public function getPayload(): ?array
    {
        return $this->payload;
    }

    /**
     * @return $this
     */
    public function setPayload(?array $payload): self
    {
        $this->payload = $payload;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    /**
     * @return $this
     */
    public function setHistory(?string $history): self
    {
        $this->history = $history;

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

    public function isMembershipSubscription(): bool
    {
        return SubscriptionType::MEMBERSHIP === $this->subscriptionType;
    }

    public function isTransferable(string $fromUser, Company $toCompany): bool
    {
        if (!$toCompany->isOwner($fromUser)) {
            return false;
        }

        if (CompanyType::FREELANCER === $toCompany->getCompanyType()) {
            return in_array($this->getSubscriptionSubType(), [MembershipType::BRONZE, MembershipType::SILVER, MembershipType::GOLD, MembershipType::PLATINUM], true)
                && in_array($this->getSubscriptionStatus(), [SubscriptionStatus::ACTIVE, SubscriptionStatus::TRIALING], true);
        }

        return in_array($this->getSubscriptionSubType(), [MembershipType::SILVER, MembershipType::GOLD, MembershipType::PLATINUM], true)
            && in_array($this->getSubscriptionStatus(), [SubscriptionStatus::ACTIVE, SubscriptionStatus::TRIALING], true);
    }

    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    /**
     * @return $this
     */
    public function setPaymentStatus(?string $paymentStatus): self
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    /**
     * @return array{category: string, isActive?: bool, isPaid?: bool}
     */
    public function getStatus(): array
    {
        return $this->status;
    }

    /**
     * @param array{category: string, isActive?: bool, isPaid?: bool} $status
     */
    public function setStatus(array $status): Subscription
    {
        $this->status = $status;

        return $this;
    }
}
