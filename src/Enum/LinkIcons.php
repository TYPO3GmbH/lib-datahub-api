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
final class LinkIcons extends AbstractEnum
{
    // Defaults & Socialmedia
    public const WEBSITE = 'website';
    public const TWITTER = 'twitter';
    public const FACEBOOK = 'facebook';
    public const INSTAGRAM = 'instagram';
    // Business profiles
    public const XING = 'xing';
    public const LINKEDIN = 'linkedin';
    // Developer
    public const GITHUB = 'github';
    public const GITLAB = 'gitlab';
    public const BITBUCKET = 'bitbucket';
    public const STACKOVERFLOW = 'stackoverflow';

    protected static array $optionNames = [
        self::WEBSITE => 'Website',
        self::TWITTER => 'Twitter',
        self::FACEBOOK => 'Facebook',
        self::INSTAGRAM => 'Instagram',
        self::XING => 'XING',
        self::LINKEDIN => 'LinkedIn',
        self::GITHUB => 'GitHub',
        self::GITLAB => 'GitLab',
        self::BITBUCKET => 'Bitbucket',
        self::STACKOVERFLOW => 'Stack Overflow',
    ];
}
