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

    /**
     * @return $this
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getVendor(): string
    {
        return $this->vendor;
    }

    /**
     * @return $this
     */
    public function setVendor(string $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function getRepository(): string
    {
        return $this->repository;
    }

    /**
     * @return $this
     */
    public function setRepository(string $repository): self
    {
        $this->repository = $repository;

        return $this;
    }

    public function getServiceDesk(): string
    {
        return $this->serviceDesk;
    }

    /**
     * @return $this
     */
    public function setServiceDesk(string $serviceDesk): self
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
     *
     * @return $this
     */
    public function setRuntimes(array $runtimes): self
    {
        $this->runtimes = $runtimes;

        return $this;
    }

    /**
     * @param EltsProductRuntime $runtime
     *
     * @return $this
     */
    public function addRuntime(EltsProductRuntime $runtime): self
    {
        $this->runtimes[] = $runtime;

        return $this;
    }
}
