<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Enum;

/**
 * @codeCoverageIgnore No need to test this ...
 */
final class PrivacySetting extends AbstractEnum
{
    public const FIRST_NAME = 'firstName';
    public const LAST_NAME = 'lastName';
    public const TITLE = 'title';
    public const EMAIL = 'email';
    public const SLACK_ID = 'slackId';
    public const DISCORD_ID = 'discordId';
    public const BIO = 'bio';
    public const AVATAR = 'avatar';
    public const LINKS = 'links';
    public const CERTIFICATIONS = 'certifications';
    public const MEMBERSHIP = 'membership';
    public const LISTING = 'listing';
    protected static array $optionNames = [
        self::FIRST_NAME => 'First name',
        self::LAST_NAME => 'Last name',
        self::TITLE => 'Title',
        self::EMAIL => 'Email',
        self::SLACK_ID => 'Slack ID',
        self::DISCORD_ID => 'Discord ID',
        self::BIO => 'Bio',
        self::AVATAR => 'Avatar',
        self::LINKS => 'Links',
        self::CERTIFICATIONS => 'Certifications',
        self::MEMBERSHIP => 'Membership',
        self::LISTING => 'Listing',
    ];
}
