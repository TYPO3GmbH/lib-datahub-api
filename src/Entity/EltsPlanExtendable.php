<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class EltsPlanExtendable
{
    private string $title;
    private string $version;
    private string $type;
    private string $runtime;
    private ?\DateTimeInterface $validFrom = null;
    private ?\DateTimeInterface $validTo = null;
    private bool $isPartnerExclusive = false;

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

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

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function isPartnerExclusive(): bool
    {
        return $this->isPartnerExclusive;
    }

    public function setIsPartnerExclusive(bool $isPartnerExclusive): EltsPlanExtendable
    {
        $this->isPartnerExclusive = $isPartnerExclusive;

        return $this;
    }
}
