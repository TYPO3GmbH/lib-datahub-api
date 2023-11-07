<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Demand;

use T3G\DatahubApiLibrary\Enum\SubscriptionType;

class OrganizationSearchDemand implements \JsonSerializable
{
    private string $term = '';
    private bool $withOrders = false;

    /**
     * @var array<int, SubscriptionType::*>|null
     */
    private ?array $subscriptionTypes = null;
    private bool $withVoucherCodes = false;
    private bool $withElts = false;

    /**
     * @var array<int, int|null>|null
     */
    private ?array $membersRange = null;

    /**
     * @param string|null $term
     *
     * @deprecated Setting term via constructor is deprecated, use ->setTerm() instead
     */
    public function __construct(string $term = null)
    {
        if (null !== $term) {
            $this->setTerm($term);
            trigger_error(
                sprintf('Calling %s with $term is deprecated, call setTerm() instead.', __METHOD__),
                E_USER_DEPRECATED
            );
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return array_filter($this->toArray(), static function ($value): bool {
            return null !== $value;
        });
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function setTerm(string $term): static
    {
        $this->term = $term;

        return $this;
    }

    public function getTerm(): string
    {
        return $this->term;
    }

    public function setWithOrders(bool $withOrders = true): static
    {
        $this->withOrders = $withOrders;

        return $this;
    }

    public function isWithOrders(): bool
    {
        return $this->withOrders;
    }

    /**
     * @param bool $withSubscriptions
     *
     * @deprecated use setSubscriptionTypes()
     */
    public function setWithSubscriptions(bool $withSubscriptions = true): static
    {
        trigger_error(
            sprintf('Calling %s is deprecated, call setSubscriptionTypes() instead.', __METHOD__),
            E_USER_DEPRECATED
        );

        if ($withSubscriptions) {
            $this->setSubscriptionTypes([SubscriptionType::MEMBERSHIP, SubscriptionType::PSL]);
        }

        return $this;
    }

    /**
     * @return bool
     *
     * @deprecated use getSubscriptionTypes()
     */
    public function isWithSubscriptions(): bool
    {
        trigger_error(
            sprintf('Calling %s is deprecated, call getSubscriptionTypes() instead.', __METHOD__),
            E_USER_DEPRECATED
        );

        return null !== $this->getSubscriptionTypes();
    }

    /**
     * @param array<int, SubscriptionType::*> $subscriptionTypes
     */
    public function setSubscriptionTypes($subscriptionTypes): static
    {
        $this->subscriptionTypes = $subscriptionTypes;

        return $this;
    }

    /**
     * @return array<int, SubscriptionType::*>|null
     */
    public function getSubscriptionTypes(): ?array
    {
        return $this->subscriptionTypes;
    }

    public function setWithVoucherCodes(bool $withVoucherCodes = true): static
    {
        $this->withVoucherCodes = $withVoucherCodes;

        return $this;
    }

    public function isWithVoucherCodes(): bool
    {
        return $this->withVoucherCodes;
    }

    public function setWithElts(bool $withElts = true): static
    {
        $this->withElts = $withElts;

        return $this;
    }

    public function isWithElts(): bool
    {
        return $this->withElts;
    }

    /**
     * @return array<int, int|null>|null
     */
    public function getMembersRange(): ?array
    {
        return $this->membersRange;
    }

    /**
     * Sets the bounds for a range.
     *
     * @param array<int, int|null> $membersRange
     */
    public function setMembersRange(array $membersRange): OrganizationSearchDemand
    {
        array_walk($membersRange, static function ($value) {
            if (!is_int($value) && null !== $value) { // @phpstan-ignore-line This is public API, we cannot rely on phpstan
                throw new \TypeError(sprintf('Invalid argument type %s supplied, expected int or null', get_debug_type($value)), 1668413253);
            }
        });

        if (2 !== count($membersRange)) {
            throw new \InvalidArgumentException('The member range must contain a lower and an upper bound. For an undefined bound, pass "null".', 1668413261);
        }
        if (is_int($membersRange[0]) && $membersRange[0] < 0) {
            throw new \InvalidArgumentException('The min part cannot be a negative value', 1668411601);
        }
        if (is_int($membersRange[1]) && $membersRange[1] < 0) {
            throw new \InvalidArgumentException('The max part cannot be a negative value', 1668411604);
        }
        if (is_int($membersRange[0]) && is_int($membersRange[1]) && $membersRange[0] > $membersRange[1]) {
            throw new \LogicException('$min cannot be larger than $max', 1668411780);
        }

        if (null !== $membersRange[0] || null !== $membersRange[1]) {
            $this->membersRange = $membersRange;
        }

        return $this;
    }
}
