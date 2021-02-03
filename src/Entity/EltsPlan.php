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
    private string $runtime;

    /**
     * @var EltsInstance[]
     */
    private array $instances = [];

    public function jsonSerialize()
    {
        return [
            'version' => $this->getVersion(),
            'type' => $this->getType(),
            'runtime' => $this->getRuntime(),
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

    public function getRuntime(): string
    {
        return $this->runtime;
    }

    public function setRuntime(string $runtime): self
    {
        $this->runtime = $runtime;
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
}
