<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Demand;

class OrderSearchDemand implements \JsonSerializable
{
    public const DATE_FIELD_CREATED_AT = 'createdAt';
    public const DATE_FIELD_LAST_INVOICE_DATE = 'lastInvoiceDate';
    public const DATE_FIELDS = [self::DATE_FIELD_CREATED_AT, self::DATE_FIELD_LAST_INVOICE_DATE];
    private ?string $companyUuid = null;
    private ?\DateTime $dateFrom = null;
    private ?\DateTime $dateUntil = null;
    private ?string $searchTerm = null;
    private string $dateField = self::DATE_FIELD_CREATED_AT;

    /**
     * @return $this
     */
    public function withCompanyUuid(string $companyUuid): self
    {
        $clone = clone $this;
        $clone->companyUuid = $companyUuid;

        return $clone;
    }

    /**
     * @return $this
     */
    public function withDateFrom(\DateTime $dateFrom): self
    {
        $clone = clone $this;
        $clone->dateFrom = $dateFrom;

        return $clone;
    }

    /**
     * @return $this
     */
    public function withDateUntil(\DateTime $dateUntil): self
    {
        $clone = clone $this;
        $clone->dateUntil = $dateUntil;

        return $clone;
    }

    /**
     * @return $this
     */
    public function withSearchTerm(string $searchTerm): self
    {
        $clone = clone $this;
        $clone->searchTerm = $searchTerm;

        return $clone;
    }

    /**
     * @return $this
     */
    public function withDateField(string $dateField): self
    {
        if (!in_array($dateField, self::DATE_FIELDS, true)) {
            throw new \InvalidArgumentException(sprintf('Date field must be one of %s. Was %s.', implode(', ', self::DATE_FIELDS), $dateField), 1612176566);
        }
        $clone = clone $this;
        $clone->dateField = $dateField;

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

    public function getDateField(): string
    {
        return $this->dateField;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if (null !== $this->companyUuid) {
            $data['companyUuid'] = $this->companyUuid;
        }

        if (null !== $this->dateFrom) {
            $data['dateFrom'] = $this->dateFrom->format(\DateTimeInterface::RFC3339_EXTENDED);
        }

        if (null !== $this->dateUntil) {
            $data['dateUntil'] = $this->dateUntil->format(\DateTimeInterface::RFC3339_EXTENDED);
        }

        if (null !== $this->searchTerm) {
            $data['searchTerm'] = $this->searchTerm;
        }

        $data['dateField'] = $this->dateField;

        return $data;
    }
}
