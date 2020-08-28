<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use DateTimeInterface;
use JsonSerializable;
use T3G\DatahubApiLibrary\Enum\SubscriptionStatus;
use T3G\DatahubApiLibrary\Enum\SubscriptionType;

class Subscription implements JsonSerializable
{
    private string $uuid = '';
    private string $subscriptionIdentifier = '';
    private string $subscriptionStatus = '';
    private string $subscriptionType = '';
    private string $subscriptionSubType = '';
    private ?DateTimeInterface $validUntil = null;
    private ?array $payload = null;

    public function jsonSerialize()
    {
        return [
            'subscriptionIdentifier' => $this->getSubscriptionIdentifier(),
            'subscriptionStatus' => $this->getSubscriptionStatus(),
            'subscriptionType' => $this->getSubscriptionType(),
            'subscriptionSubType' => $this->getSubscriptionSubType(),
            'validUntil' => $this->formatDateIfGiven($this->getValidUntil()),
            'payload' => $this->getPayload(),
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

    public function getSubscriptionIdentifier(): string
    {
        return $this->subscriptionIdentifier;
    }

    public function setSubscriptionIdentifier(string $subscriptionIdentifier): self
    {
        $this->subscriptionIdentifier = $subscriptionIdentifier;
        return $this;
    }

    public function getSubscriptionStatus(): string
    {
        return $this->subscriptionStatus;
    }

    public function setSubscriptionStatus(string $subscriptionStatus): self
    {
        if (!in_array($subscriptionStatus, SubscriptionStatus::getAvailableOptions(), true)) {
            throw new \InvalidArgumentException('Invalid subscription type');
        }
        $this->subscriptionStatus = $subscriptionStatus;
        return $this;
    }

    public function getSubscriptionType(): string
    {
        return $this->subscriptionType;
    }

    public function setSubscriptionType(string $subscriptionType): self
    {
        if (!in_array($subscriptionType, SubscriptionType::getAvailableOptions(), true)) {
            throw new \InvalidArgumentException('Invalid subscription type');
        }
        $this->subscriptionType = $subscriptionType;
        return $this;
    }

    public function getSubscriptionSubType(): string
    {
        return $this->subscriptionSubType;
    }

    public function setSubscriptionSubType(string $subscriptionSubType): self
    {
        $allowedSubTypes = SubscriptionType::getAllowedSubTypes($this->getSubscriptionType());
        if (null === $allowedSubTypes || !in_array($subscriptionSubType, $allowedSubTypes, true)) {
            throw new \InvalidArgumentException('Invalid subscription sub type');
        }
        $this->subscriptionSubType = $subscriptionSubType;
        return $this;
    }

    public function getValidUntil(): ?DateTimeInterface
    {
        return $this->validUntil;
    }

    public function setValidUntil(?DateTimeInterface $validUntil): self
    {
        $this->validUntil = $validUntil;
        return $this;
    }

    public function getPayload(): ?array
    {
        return $this->payload;
    }

    public function setPayload(?array $payload): self
    {
        $this->payload = $payload;
        return $this;
    }

    private function formatDateIfGiven(?\DateTimeInterface $dateTime): ?string
    {
        return null !== $dateTime ? $dateTime->format(\DateTimeInterface::ATOM) :  null;
    }
}
