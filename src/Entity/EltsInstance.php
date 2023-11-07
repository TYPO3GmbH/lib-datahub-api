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

    /**
     * @return $this
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getEltsPlan(): EltsPlan
    {
        return $this->eltsPlan;
    }

    /**
     * @return $this
     */
    public function setEltsPlan(EltsPlan $eltsPlan): self
    {
        $this->eltsPlan = $eltsPlan;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @return $this
     */
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
     *
     * @return $this
     */
    public function setOwnerData(array $ownerData): self
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
     *
     * @return $this
     */
    public function setTechnicalContacts(array $technicalContacts): self
    {
        $this->technicalContacts = $technicalContacts;

        return $this;
    }

    /**
     * @return $this
     */
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
     *
     * @return $this
     */
    public function setReleaseNotifications(array $releaseNotifications): self
    {
        $this->releaseNotifications = $releaseNotifications;

        return $this;
    }

    /**
     * @return $this
     */
    public function addReleaseNotification(ReleaseNotification $releaseNotification): self
    {
        $this->releaseNotifications[] = $releaseNotification;

        return $this;
    }
}
