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

    /**
     * @return string[]
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
