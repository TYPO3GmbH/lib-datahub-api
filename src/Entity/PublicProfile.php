<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class PublicProfile
{
    private string $username;

    /**
     * @var array<string, mixed>|null
     */
    private ?array $status = null;
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $title = null;
    private ?string $email = null;
    private ?string $slackId = null;
    private ?string $discordId = null;
    private ?string $bio = null;
    private ?string $avatar = null;

    /**
     * @var Link[]|null
     */
    private ?array $links = null;

    /** @var Certification[]|null */
    private ?array $certifications = null;
    private ?Subscription $membership = null;
    private ?PrivacySettings $privacySettings = null;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): PublicProfile
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getStatus(): ?array
    {
        return $this->status;
    }

    /**
     * @param array<string, mixed>|null $status
     */
    public function setStatus(?array $status): PublicProfile
    {
        $this->status = $status;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): PublicProfile
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): PublicProfile
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): PublicProfile
    {
        $this->title = $title;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): PublicProfile
    {
        $this->email = $email;

        return $this;
    }

    public function getSlackId(): ?string
    {
        return $this->slackId;
    }

    public function setSlackId(?string $slackId): PublicProfile
    {
        $this->slackId = $slackId;

        return $this;
    }

    public function getDiscordId(): ?string
    {
        return $this->discordId;
    }

    public function setDiscordId(?string $discordId): PublicProfile
    {
        $this->discordId = $discordId;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): PublicProfile
    {
        $this->bio = $bio;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): PublicProfile
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Link[]|null
     */
    public function getLinks(): ?array
    {
        return $this->links;
    }

    /**
     * @param Link[]|null $links
     */
    public function setLinks(?array $links): PublicProfile
    {
        $this->links = $links;

        return $this;
    }

    /**
     * @return Certification[]|null
     */
    public function getCertifications(): ?array
    {
        return $this->certifications;
    }

    /**
     * @param Certification[]|null $certifications
     */
    public function setCertifications(?array $certifications): PublicProfile
    {
        $this->certifications = $certifications;

        return $this;
    }

    public function getMembership(): ?Subscription
    {
        return $this->membership;
    }

    public function setMembership(?Subscription $membership): PublicProfile
    {
        $this->membership = $membership;

        return $this;
    }

    public function getPrivacySettings(): ?PrivacySettings
    {
        return $this->privacySettings;
    }

    public function setPrivacySettings(?PrivacySettings $privacySettings): PublicProfile
    {
        $this->privacySettings = $privacySettings;

        return $this;
    }
}
