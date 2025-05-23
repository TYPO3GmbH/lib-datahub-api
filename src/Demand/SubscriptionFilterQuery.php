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
    private bool $onlyActive = false;
    private ?string $company = null;
    private ?string $user = null;

    public function __toString()
    {
        return $this->getQueryAsString();
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

    /** @return array<int, string> */
    public function getSubscriptionStatus(): array
    {
        return $this->subscriptionStatus;
    }

    /**
     * @param array<int, string> $subscriptionStatus
     *
     * @return $this
     */
    public function setSubscriptionStatus(array $subscriptionStatus): self
    {
        $this->subscriptionStatus = $subscriptionStatus;

        return $this;
    }

    /**
     * @return $this
     */
    public function addSubscriptionStatus(string $subscriptionStatus): self
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
     *
     * @return $this
     */
    public function setSubscriptionType(array $subscriptionType): self
    {
        $this->subscriptionType = $subscriptionType;

        return $this;
    }

    /**
     * @return $this
     */
    public function addSubscriptionType(string $subscriptionType): self
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
     *
     * @return $this
     */
    public function setSubscriptionSubType(array $subscriptionSubType): self
    {
        $this->subscriptionSubType = $subscriptionSubType;

        return $this;
    }

    /**
     * @return $this
     */
    public function addSubscriptionSubType(string $subscriptionSubType): self
    {
        $this->subscriptionSubType[] = $subscriptionSubType;

        return $this;
    }

    public function isOnlyActive(): bool
    {
        return $this->onlyActive;
    }

    public function setOnlyActive(bool $onlyActive): SubscriptionFilterQuery
    {
        $this->onlyActive = $onlyActive;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): SubscriptionFilterQuery
    {
        $this->company = $company;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(?string $user): SubscriptionFilterQuery
    {
        $this->user = $user;

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
        if (false !== $this->onlyActive) {
            $params['onlyActive'] = true;
        }
        if (null !== $this->company) {
            $params['company'] = $this->company;
        }
        if (null !== $this->user) {
            $params['user'] = $this->user;
        }

        return http_build_query($params);
    }
}
