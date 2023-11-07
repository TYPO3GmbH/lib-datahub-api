<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class EltsInstance implements \JsonSerializable
{
    private string $uuid;
    private string $name;
    private string $owner;

    /**
     * @var array<string, string>
     */
    private array $ownerData = [];
    private EltsPlan $eltsPlan;

    /**
     * @var TechnicalContact[]
     */
    private array $technicalContacts = [];

    /**
     * @var ReleaseNotification[]
     */
    private array $releaseNotifications = [];

    /**
     * @return array{name: string}
     */
    public function jsonSerialize(): array
    {
        return [
            'name' => $this->getName(),
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

    public function getEltsPlan(): EltsPlan
    {
        return $this->eltsPlan;
    }

    public function setEltsPlan(EltsPlan $eltsPlan): static
    {
        $this->eltsPlan = $eltsPlan;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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
