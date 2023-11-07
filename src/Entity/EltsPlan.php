<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use T3G\DatahubApiLibrary\Enum\PaymentStatus;

class EltsPlan implements \JsonSerializable
{
    private string $uuid;
    private string $version;
    private string $type;
    private ?string $title = null;

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

    public function setUuid(string $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): static
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
     */
    public function setOwnerData(array $ownerData): static
    {
        $this->ownerData = $ownerData;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
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
     */
    public function setExtendables(array $extendables): static
    {
        $this->extendables = $extendables;

        return $this;
    }

    public function addExtendable(EltsPlanExtendable $extendable): static
    {
        $this->extendables[$extendable->getRuntime()] = $extendable;

        return $this;
    }

    public function getRuntime(): string
    {
        $paidRuntimes = array_filter($this->runtimes, static function (EltsRuntime $eltsRuntime) {
            return PaymentStatus::PAID === $eltsRuntime->getPaymentStatus();
        });

        $activeRuntime = null;
        $now = new \DateTimeImmutable();

        foreach ($paidRuntimes as $runtime) {
            if ($runtime->getValidFrom() <= $now && $runtime->getValidTo() >= $now) {
                $activeRuntime = $runtime;
                break;
            }
        }

        if (null !== $activeRuntime) {
            return $activeRuntime->getRuntime();
        }

        $paidRuntime = end($paidRuntimes);
        if (false !== $paidRuntime) {
            return $paidRuntime->getRuntime();
        }

        return '';
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
     */
    public function setRuntimes(array $runtimes): static
    {
        $this->runtimes = $runtimes;

        return $this;
    }

    public function addRuntime(EltsRuntime $runtime): static
    {
        $this->runtimes[] = $runtime;

        return $this;
    }

    public function getValidFrom(): ?\DateTimeInterface
    {
        return $this->validFrom;
    }

    public function setValidFrom(?\DateTimeInterface $validFrom): static
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    public function getValidTo(): ?\DateTimeInterface
    {
        return $this->validTo;
    }

    public function setValidTo(?\DateTimeInterface $validTo): static
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
     */
    public function setInstances(array $instances): static
    {
        $this->instances = $instances;

        return $this;
    }

    public function addInstance(EltsInstance $instance): static
    {
        $this->instances[] = $instance;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order = null): static
    {
        $this->order = $order;

        return $this;
    }

    public function getLicenses(): ?int
    {
        return $this->licenses;
    }

    public function setLicenses(?int $licenses): static
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
     */
    public function setTechnicalContacts(array $technicalContacts): static
    {
        $this->technicalContacts = $technicalContacts;

        return $this;
    }

    public function addTechnicalContact(TechnicalContact $technicalContacts): static
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
     */
    public function setReleaseNotifications(array $releaseNotifications): static
    {
        $this->releaseNotifications = $releaseNotifications;

        return $this;
    }

    public function addReleaseNotification(ReleaseNotification $releaseNotification): static
    {
        $this->releaseNotifications[] = $releaseNotification;

        return $this;
    }
}
