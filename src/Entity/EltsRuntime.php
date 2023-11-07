<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class EltsRuntime
{
    private string $uuid;
    private string $runtime;
    private ?Order $order = null;
    private string $paymentStatus;
    private ?\DateTimeInterface $validFrom = null;
    private ?\DateTimeInterface $validTo = null;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return $this
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getRuntime(): string
    {
        return $this->runtime;
    }

    /**
     * @return $this
     */
    public function setRuntime(string $runtime): self
    {
        $this->runtime = $runtime;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    /**
     * @return $this
     */
    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getPaymentStatus(): string
    {
        return $this->paymentStatus;
    }

    /**
     * @return $this
     */
    public function setPaymentStatus(string $paymentStatus): self
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    public function getValidFrom(): ?\DateTimeInterface
    {
        return $this->validFrom;
    }

    /**
     * @return $this
     */
    public function setValidFrom(?\DateTimeInterface $validFrom): self
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    public function getValidTo(): ?\DateTimeInterface
    {
        return $this->validTo;
    }

    /**
     * @return $this
     */
    public function setValidTo(?\DateTimeInterface $validTo): self
    {
        $this->validTo = $validTo;

        return $this;
    }
}
