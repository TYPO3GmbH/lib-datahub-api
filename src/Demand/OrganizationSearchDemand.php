<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Demand;

class OrganizationSearchDemand implements \JsonSerializable
{
    private string $term;
    private bool $withOrders = false;
    private bool $withSubscriptions = false;
    private bool $withVoucherCodes = false;
    private bool $withElts = false;

    public function __construct(string $term)
    {
        $this->term = $term;
    }

    /**
     * @return array<string, bool>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @return array<string, bool>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function getTerm(): string
    {
        return $this->term;
    }

    public function setWithOrders(bool $withOrders = true): self
    {
        $this->withOrders = $withOrders;

        return clone $this;
    }

    public function isWithOrders(): bool
    {
        return $this->withOrders;
    }

    public function setWithSubscriptions(bool $withSubscriptions = true): self
    {
        $this->withSubscriptions = $withSubscriptions;

        return clone $this;
    }

    public function isWithSubscriptions(): bool
    {
        return $this->withSubscriptions;
    }

    public function setWithVoucherCodes(bool $withVoucherCodes = true): self
    {
        $this->withVoucherCodes = $withVoucherCodes;

        return clone $this;
    }

    public function isWithVoucherCodes(): bool
    {
        return $this->withVoucherCodes;
    }

    public function setWithElts(bool $withElts = true): self
    {
        $this->withElts = $withElts;

        return clone $this;
    }

    public function isWithElts(): bool
    {
        return $this->withElts;
    }
}
