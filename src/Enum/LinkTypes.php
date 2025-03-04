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
final class LinkTypes extends AbstractEnum
{
    // Defaults & social media
    public const WEBSITE = 'website';
    public const X = 'x';
    public const FACEBOOK = 'facebook';
    public const INSTAGRAM = 'instagram';
    public const MASTODON = 'mastodon';
    public const BLUESKY = 'bluesky';
    public const THREADS = 'threads';
    public const YOUTUBE = 'youtube';
    // Business profiles
    public const XING = 'xing';
    public const LINKEDIN = 'linkedin';
    // Developer
    public const GITHUB = 'github';
    public const GITLAB = 'gitlab';
    public const STACKOVERFLOW = 'stackoverflow';
    // Other
    public const OTHER = 'other';
    protected static array $optionNames = [
        self::WEBSITE => 'Website',
        self::X => 'X',
        self::FACEBOOK => 'Facebook',
        self::INSTAGRAM => 'Instagram',
        self::MASTODON => 'Mastodon',
        self::BLUESKY => 'Bluesky',
        self::THREADS => 'Threads',
        self::YOUTUBE => 'YouTube',
        self::XING => 'XING',
        self::LINKEDIN => 'LinkedIn',
        self::GITHUB => 'GitHub',
        self::GITLAB => 'GitLab',
        self::STACKOVERFLOW => 'Stack Overflow',
        self::OTHER => 'Other',
    ];

    /**
     * @var string[]
     */
    protected static array $iconIdentifiers = [
        self::WEBSITE => 'actions-globe-alt',
        self::X => 'actions-brand-x',
        self::FACEBOOK => 'actions-brand-facebook',
        self::INSTAGRAM => 'actions-brand-instagram',
        self::MASTODON => 'actions-brand-mastodon',
        self::BLUESKY => 'actions-brand-bluesky',
        self::THREADS => 'actions-brand-threads',
        self::YOUTUBE => 'actions-brand-youtube',
        self::XING => 'actions-brand-xing',
        self::LINKEDIN => 'actions-brand-linkedin',
        self::GITHUB => 'actions-brand-github',
        self::GITLAB => 'actions-brand-gitlab',
        self::STACKOVERFLOW => 'actions-link',
        self::OTHER => 'actions-link',
    ];

    /**
     * @var string[]
     */
    protected static array $urlPrefixes = [
        self::WEBSITE => 'https://',
        self::X => 'https://x.com/',
        self::FACEBOOK => 'https://www.facebook.com/',
        self::INSTAGRAM => 'https://www.instagram.com/',
        self::MASTODON => 'https://',
        self::BLUESKY => 'https://bsky.app/profile/',
        self::THREADS => 'https://www.threads.net/@',
        self::YOUTUBE => 'https://www.youtube.com/@',
        self::XING => 'https://www.xing.com/profile/',
        self::LINKEDIN => 'https://www.linkedin.com/in/',
        self::GITHUB => 'https://github.com/',
        self::GITLAB => 'https://gitlab.com/',
        self::STACKOVERFLOW => 'https://stackoverflow.com/',
        self::OTHER => 'https://',
    ];

    public static function getIconIdentifier(string $option): string
    {
        return static::$iconIdentifiers[$option] ?? '';
    }

    public static function getUrlPrefix(string $option): string
    {
        return static::$urlPrefixes[$option] ?? '';
    }
}
