<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\PublicProfile;

/**
 * @extends AbstractFactory<PublicProfile>
 */
class PublicProfileFactory extends AbstractFactory
{
    /**
     * @param array{
     *     username?: ?string,
     *     status?: ?array<string, mixed>,
     *     firstName?: ?string,
     *     lastName?: ?string,
     *     title?: ?string,
     *     email?: ?string,
     *     slackId?: ?string,
     *     discordId?: ?string,
     *     bio?: ?string,
     *     avatar?: ?bool,
     *     links?: ?array<string, array{uuid: string, type: string, value: string, highlight: bool}>,
     *     certifications?: ?array<string, array<string, mixed>>,
     *     membership?: array<string, mixed>
     *  } $data
     */
    public static function fromArray(array $data): PublicProfile
    {
        $publicProfile = new PublicProfile();

        if (isset($data['username'])) {
            $publicProfile->setUsername($data['username']);
        }
        if (isset($data['status'])) {
            $publicProfile->setStatus($data['status']);
        }
        if (isset($data['firstName'])) {
            $publicProfile->setFirstName($data['firstName']);
        }
        if (isset($data['lastName'])) {
            $publicProfile->setLastName($data['lastName']);
        }
        if (isset($data['title'])) {
            $publicProfile->setTitle($data['title']);
        }
        if (isset($data['email'])) {
            $publicProfile->setEmail($data['email']);
        }
        if (isset($data['slackId'])) {
            $publicProfile->setSlackId($data['slackId']);
        }
        if (isset($data['discordId'])) {
            $publicProfile->setDiscordId($data['discordId']);
        }
        if (isset($data['bio'])) {
            $publicProfile->setBio($data['bio']);
        }
        if (isset($data['avatar'])) {
            $publicProfile->setAvatar($data['avatar']);
        }
        if (isset($data['links'])) {
            $publicProfile->setLinks(array_map(static function ($link) {
                return LinkFactory::fromArray($link);
            }, $data['links']));
        }
        if (isset($data['certifications'])) {
            $publicProfile->setCertifications(array_map(static function ($certification) {
                return CertificationFactory::fromArray($certification);
            }, $data['certifications']));
        }
        if (isset($data['membership'])) {
            $publicProfile->setMembership(SubscriptionFactory::fromArray($data['membership']));
        }

        return $publicProfile;
    }
}
