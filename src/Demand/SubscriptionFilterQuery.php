<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Demand;

class SubscriptionFilterQuery
{
    private string $subscriptionIdentifier = '';

    /** @var array<int, string> */
    private array $subscriptionStatus = [];

    /** @var array<int, string> */
    private array $subscriptionType = [];

    /** @var array<int, string> */
    private array $subscriptionSubType = [];

    public function __toString()
    {
        return $this->getQueryAsString();
    }

    public function getSubscriptionIdentifier(): string
    {
        return $this->subscriptionIdentifier;
    }

    public function setSubscriptionIdentifier(string $subscriptionIdentifier): static
    {
        $this->subscriptionIdentifier = $subscriptionIdentifier;

        return $this;
    }

    /** @return array<int, string> */
    public function getSubscriptionStatus(): array
    {
        return $this->subscriptionStatus;
    }

    /**
     * @param array<int, string> $subscriptionStatus
     */
    public function setSubscriptionStatus(array $subscriptionStatus): static
    {
        $this->subscriptionStatus = $subscriptionStatus;

        return $this;
    }

    public function addSubscriptionStatus(string $subscriptionStatus): static
    {
        $this->subscriptionStatus[] = $subscriptionStatus;

        return $this;
    }

    /** @return array<int, string> */
    public function getSubscriptionType(): array
    {
        return $this->subscriptionType;
    }

    /**
     * @param array<int, string> $subscriptionType
     */
    public function setSubscriptionType(array $subscriptionType): static
    {
        $this->subscriptionType = $subscriptionType;

        return $this;
    }

    public function addSubscriptionType(string $subscriptionType): static
    {
        $this->subscriptionType[] = $subscriptionType;

        return $this;
    }

    /** @return array<int, string> */
    public function getSubscriptionSubType(): array
    {
        return $this->subscriptionSubType;
    }

    /**
     * @param array<int, string> $subscriptionSubType
     */
    public function setSubscriptionSubType(array $subscriptionSubType): static
    {
        $this->subscriptionSubType = $subscriptionSubType;

        return $this;
    }

    public function addSubscriptionSubType(string $subscriptionSubType): static
    {
        $this->subscriptionSubType[] = $subscriptionSubType;

        return $this;
    }

    public function getQueryAsString(): string
    {
        $params = [];
        if ('' !== $this->subscriptionIdentifier) {
            $params['subscriptionIdentifier'] = $this->subscriptionIdentifier;
        }
        if ([] !== $this->subscriptionStatus) {
            $params['subscriptionStatus'] = $this->subscriptionStatus;
        }
        if ([] !== $this->subscriptionType) {
            $params['subscriptionType'] = $this->subscriptionType;
        }
        if ([] !== $this->subscriptionSubType) {
            $params['subscriptionSubType'] = $this->subscriptionSubType;
        }

        return http_build_query($params);
    }
}
