<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class EltsProduct
{
    private string $version;
    private string $vendor;
    private string $repository;
    private string $serviceDesk;

    /**
     * @var EltsProductRuntime[]
     */
    private array $runtimes = [];

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getVendor(): string
    {
        return $this->vendor;
    }

    public function setVendor(string $vendor): static
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function getRepository(): string
    {
        return $this->repository;
    }

    public function setRepository(string $repository): static
    {
        $this->repository = $repository;

        return $this;
    }

    public function getServiceDesk(): string
    {
        return $this->serviceDesk;
    }

    public function setServiceDesk(string $serviceDesk): static
    {
        $this->serviceDesk = $serviceDesk;

        return $this;
    }

    /**
     * @return EltsProductRuntime[]
     */
    public function getRuntimes(): array
    {
        return $this->runtimes;
    }

    /**
     * @param EltsProductRuntime[] $runtimes
     */
    public function setRuntimes(array $runtimes): static
    {
        $this->runtimes = $runtimes;

        return $this;
    }

    /**
     * @param EltsProductRuntime $runtime
     */
    public function addRuntime(EltsProductRuntime $runtime): static
    {
        $this->runtimes[] = $runtime;

        return $this;
    }
}
