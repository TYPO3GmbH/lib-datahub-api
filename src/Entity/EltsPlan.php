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
    private ?string $title = null;
    private string $runtime;

    /**
     * @var EltsPlanExtendable[]
     */
    private array $extendables = [];

    /**
     * @var EltsRuntime[]
     */
    private array $runtimes = [];
    private string $owner;

    /**
     * @var array<string, string>
     */
    private array $ownerData = [];
    private ?Order $order = null;
    private ?\DateTimeInterface $validFrom = null;
    private ?\DateTimeInterface $validTo = null;
    private ?int $licenses = 0;

    /**
     * @var TechnicalContact[]
     */
    private array $technicalContacts = [];

    /**
     * @var ReleaseNotification[]
     */
    private array $releaseNotifications = [];

    /**
     * @var EltsInstance[]
     */
    private array $instances = [];

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'version' => $this->getVersion(),
            'type' => $this->getType(),
            'title' => $this->getTitle(),
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

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return array<string, string>
     */
    public function getOwnerData(): array
    {
        return $this->ownerData;
    }

    /**
     * @param array<string, string> $ownerData
     * @return $this
     */
    public function setOwnerData(array $ownerData): self
    {
        $this->ownerData = $ownerData;
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

    /**
     * @return EltsPlanExtendable[]
     */
    public function getExtendables(): array
    {
        return $this->extendables;
    }

    /**
     * @param EltsPlanExtendable[] $extendables
     * @return self
     */
    public function setExtendables(array $extendables): self
    {
        $this->extendables = $extendables;
        return $this;
    }

    public function addExtendable(EltsPlanExtendable $extendable): self
    {
        $this->extendables[$extendable->getRuntime()] = $extendable;

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
     * @return EltsRuntime[]
     */
    public function getRuntimes(): array
    {
        return $this->runtimes;
    }

    /**
     * @param EltsRuntime[] $runtimes
     * @return self
     */
    public function setRuntimes(array $runtimes): self
    {
        $this->runtimes = $runtimes;
        return $this;
    }

    public function addRuntime(EltsRuntime $runtime): self
    {
        $this->runtimes[] = $runtime;
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

    /**
     * @return TechnicalContact[]
     */
    public function getTechnicalContacts(): array
    {
        return $this->technicalContacts;
    }

    /**
     * @param TechnicalContact[] $technicalContacts
     * @return self
     */
    public function setTechnicalContacts(array $technicalContacts): self
    {
        $this->technicalContacts = $technicalContacts;
        return $this;
    }

    public function addTechnicalContact(TechnicalContact $technicalContacts): self
    {
        $this->technicalContacts[] = $technicalContacts;
        return $this;
    }

    /**
     * @return ReleaseNotification[]
     */
    public function getReleaseNotifications(): array
    {
        return $this->releaseNotifications;
    }

    /**
     * @param ReleaseNotification[] $releaseNotifications
     * @return self
     */
    public function setReleaseNotifications(array $releaseNotifications): self
    {
        $this->releaseNotifications = $releaseNotifications;
        return $this;
    }

    public function addReleaseNotification(ReleaseNotification $releaseNotification): self
    {
        $this->releaseNotifications[] = $releaseNotification;
        return $this;
    }
}
