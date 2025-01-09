<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\PrivacySettingsFactory;

class PrivacySettingsFactoryTest extends TestCase
{
    #[DataProvider('factoryDataProvider')]
    public function testFactory(array $data, array $expectations): void
    {
        $privacySettings = PrivacySettingsFactory::fromArray($data);
        $publicProfileScope = $privacySettings->getScope('public-profile');

        self::assertSame($expectations['public-profile']['firstName'], $publicProfileScope->getProperty('firstName'));
        self::assertSame($expectations['public-profile']['lastName'], $publicProfileScope->getProperty('lastName'));
        self::assertSame($expectations['public-profile']['title'], $publicProfileScope->getProperty('title'));
        self::assertSame($expectations['public-profile']['email'], $publicProfileScope->getProperty('email'));
        self::assertSame($expectations['public-profile']['slackId'], $publicProfileScope->getProperty('slackId'));
        self::assertSame($expectations['public-profile']['discordId'], $publicProfileScope->getProperty('discordId'));
        self::assertSame($expectations['public-profile']['bio'], $publicProfileScope->getProperty('bio'));
        self::assertSame($expectations['public-profile']['avatar'], $publicProfileScope->getProperty('avatar'));
        self::assertSame($expectations['public-profile']['links'], $publicProfileScope->getProperty('links'));
        self::assertSame($expectations['public-profile']['certifications'], $publicProfileScope->getProperty('certifications'));
        self::assertSame($expectations['public-profile']['membership'], $publicProfileScope->getProperty('membership'));
    }

    public static function factoryDataProvider(): array
    {
        return [
            'all values set' => [
                'data' => [
                    'public-profile' => [
                        'firstName' => 'public',
                        'lastName' => 'public',
                        'title' => 'private',
                        'email' => 'public',
                        'slackId' => 'private',
                        'discordId' => 'private',
                        'bio' => 'private',
                        'avatar' => 'public',
                        'links' => 'public',
                        'certifications' => 'private',
                        'membership' => 'logged-in',
                    ],
                ],
                'expectations' => [
                    'public-profile' => [
                        'firstName' => 'public',
                        'lastName' => 'public',
                        'title' => 'private',
                        'email' => 'public',
                        'slackId' => 'private',
                        'discordId' => 'private',
                        'bio' => 'private',
                        'avatar' => 'public',
                        'links' => 'public',
                        'certifications' => 'private',
                        'membership' => 'logged-in',
                    ],
                ],
            ],
            'single value set' => [
                'data' => [
                    'public-profile' => [
                        'firstName' => 'public',
                    ],
                ],
                'expectations' => [
                    'public-profile' => [
                        'firstName' => 'public',
                        'lastName' => 'private',
                        'title' => 'public',
                        'email' => 'private',
                        'slackId' => 'logged-in',
                        'discordId' => 'logged-in',
                        'bio' => 'public',
                        'avatar' => 'logged-in',
                        'links' => 'logged-in',
                        'certifications' => 'public',
                        'membership' => 'public',
                    ],
                ],
            ],
            'no values set' => [
                'data' => [],
                'expectations' => [
                    'public-profile' => [
                        'firstName' => 'private',
                        'lastName' => 'private',
                        'title' => 'public',
                        'email' => 'private',
                        'slackId' => 'logged-in',
                        'discordId' => 'logged-in',
                        'bio' => 'public',
                        'avatar' => 'logged-in',
                        'links' => 'logged-in',
                        'certifications' => 'public',
                        'membership' => 'public',
                    ],
                ],
            ],
        ];
    }
}
