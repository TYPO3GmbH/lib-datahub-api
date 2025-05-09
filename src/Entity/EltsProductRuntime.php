<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class EltsProductRuntime
{
    private string $identifier;
    private \DateTimeInterface $validFrom;
    private \DateTimeInterface $validTo;

    /**
     * @var string[]|null
     */
    private ?array $externalProductIds;

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @return $this
     */
    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getValidFrom(): \DateTimeInterface
    {
        return $this->validFrom;
    }

    /**
     * @return $this
     */
    public function setValidFrom(\DateTimeInterface $validFrom): self
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    public function getValidTo(): \DateTimeInterface
    {
        return $this->validTo;
    }

    /**
     * @return $this
     */
    public function setValidTo(\DateTimeInterface $validTo): self
    {
        $this->validTo = $validTo;

        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getExternalProductIds(): ?array
    {
        return $this->externalProductIds;
    }

    /**
     * @param string[]|null $externalProductIds
     */
    public function setExternalProductIds(?array $externalProductIds): EltsProductRuntime
    {
        $this->externalProductIds = $externalProductIds;

        return $this;
    }
}
