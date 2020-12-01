<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Demand;

class OrderSearchDemand implements \JsonSerializable
{
    private ?string $companyUuid = null;
    private ?\DateTime $dateFrom = null;
    private ?\DateTime $dateUntil = null;
    private ?string $searchTerm = null;

    public function __construct()
    {
    }

    public function withCompanyUuid(string $companyUuid): self
    {
        $clone = clone $this;
        $clone->companyUuid = $companyUuid;
        return $clone;
    }

    public function withDateFrom(\DateTime $dateFrom): self
    {
        $clone = clone $this;
        $clone->dateFrom = $dateFrom;
        return $clone;
    }

    public function withDateUntil(\DateTime $dateUntil): self
    {
        $clone = clone $this;
        $clone->dateUntil = $dateUntil;
        return $clone;
    }

    public function withSearchTerm(string $searchTerm): self
    {
        $clone = clone $this;
        $clone->searchTerm = $searchTerm;
        return $clone;
    }

    public function getCompanyUuid(): ?string
    {
        return $this->companyUuid;
    }

    public function getDateFrom(): ?\DateTime
    {
        return $this->dateFrom;
    }

    public function getDateUntil(): ?\DateTime
    {
        return $this->dateUntil;
    }

    public function getSearchTerm(): ?string
    {
        return $this->searchTerm;
    }

    public function jsonSerialize()
    {
        $data = [];

        if (null !== $this->companyUuid) {
            $data['companyUuid'] = $this->companyUuid;
        }

        if (null !== $this->dateFrom) {
            $data['dateFrom'] = $this->dateFrom->format(\DateTime::RFC3339_EXTENDED);
        }

        if (null !== $this->dateUntil) {
            $data['dateUntil'] = $this->dateUntil->format(\DateTime::RFC3339_EXTENDED);
        }

        if (null !== $this->searchTerm) {
            $data['searchTerm'] = $this->searchTerm;
        }

        return $data;
    }
}
