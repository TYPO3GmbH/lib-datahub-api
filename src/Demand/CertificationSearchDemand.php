<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Demand;

class CertificationSearchDemand implements \JsonSerializable
{
    private string $sortDirection = 'ASC';
    private string $sortField = 'examDate';
    private ?string $filter = null;
    private string $term = '';

    /** @var array<int, string> */
    private array $status = [];
    private ?string $eventUuid = null;
    private ?int $limit = null;
    private ?int $offset = 0;

    public function getSortDirection(): string
    {
        return $this->sortDirection;
    }

    public function setSortDirection(string $sortDirection): void
    {
        $this->sortDirection = strtoupper($sortDirection);
    }

    public function getSortField(): string
    {
        return $this->sortField;
    }

    public function setSortField(string $sortField): void
    {
        if (in_array($sortField, ['examDate', 'certificatePrintDate', 'examLocation'])) {
            $this->sortField = $sortField;
        }
    }

    public function getFilter(): ?string
    {
        return $this->filter;
    }

    public function setFilter(?string $filter): void
    {
        $this->filter = $filter;
    }

    public function getTerm(): string
    {
        return $this->term;
    }

    /**
     * @param string $term
     */
    public function setTerm(string $term): void
    {
        $this->term = $term;
    }

    /**
     * @return string[]
     */
    public function getStatus(): array
    {
        return $this->status;
    }

    /**
     * @param string[] $status
     */
    public function setStatus(array $status): void
    {
        $this->status = $status;
    }

    public function getEventUuid(): ?string
    {
        return $this->eventUuid;
    }

    public function setEventUuid(?string $eventUuid): void
    {
        $this->eventUuid = $eventUuid;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function setLimit(?int $limit): void
    {
        $this->limit = $limit;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }

    public function setOffset(?int $offset): void
    {
        $this->offset = $offset;
    }
}
