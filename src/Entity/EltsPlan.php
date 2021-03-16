<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use JsonSerializable;

class EltsPlan implements JsonSerializable
{
    private string $uuid;
    private string $version;
    private string $type;
    private ?string $title;
    private string $runtime;
    private ?Order $order = null;
    private ?\DateTimeInterface $validFrom = null;
    private ?\DateTimeInterface $validTo = null;
    private ?int $licenses = 0;

    /**
     * @var EltsInstance[]
     */
    private array $instances = [];

    public function jsonSerialize()
    {
        return [
            'version' => $this->getVersion(),
            'type' => $this->getType(),
            'title' => $this->getTitle(),
            'runtime' => $this->getRuntime(),
            'order' => $this->getOrder(),
            'validFrom' => $this->getValidFrom(),
            'validTo' => $this->getValidTo(),
            'licenses' => $this->getLicenses(),
        ];
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getRuntime(): string
    {
        return $this->runtime;
    }

    public function setRuntime(string $runtime): self
    {
        $this->runtime = $runtime;
        return $this;
    }

    public function getValidFrom(): ?\DateTimeInterface
    {
        return $this->validFrom;
    }

    public function setValidFrom(?\DateTimeInterface $validFrom): self
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    public function getValidTo(): ?\DateTimeInterface
    {
        return $this->validTo;
    }

    public function setValidTo(?\DateTimeInterface $validTo): self
    {
        $this->validTo = $validTo;

        return $this;
    }

    /**
     * @return EltsInstance[]
     */
    public function getInstances(): array
    {
        return $this->instances;
    }

    /**
     * @param EltsInstance[] $instances
     * @return EltsPlan
     */
    public function setInstances(array $instances): self
    {
        $this->instances = $instances;
        return $this;
    }

    public function addInstance(EltsInstance $instance): self
    {
        $this->instances[] = $instance;
        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order = null): self
    {
        $this->order = $order;
        return $this;
    }

    public function getLicenses(): ?int
    {
        return $this->licenses;
    }

    public function setLicenses(?int $licenses): self
    {
        $this->licenses = $licenses;

        return $this;
    }
}
