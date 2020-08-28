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
final class PSLType extends AbstractEnum
{
    public const LOGO = 'logo';
    public const BACKLINK = 'backlink';
    public const PROFILE_PAGE = 'profile_page';
    public const MAP_VIEW = 'map_view';
    public const CONTACT_FORM = 'contact_form';
    public const INDUSTRY = 'industry';
    public const BADGE_HOSTING = 'badge_hosting';
    public const BADGE_DEVELOPMENT = 'badge_development';
    public const BADGE_DESIGN = 'badge_design';
    public const BADGE_CONSULTING = 'badge_consulting';
    public const SOCIAL_MEDIA_CHANNEL= 'social_media_channel';
    public const ADDITIONAL_LOCATION = 'additional_location';
    public const PROFILE_BUNDLE = 'profile_bundle';
    public const PHOTO = 'photo';

    protected static array $optionNames = [
        self::LOGO => 'Logo',
        self::BACKLINK => 'Backlink',
        self::PROFILE_PAGE => 'Profile Page',
        self::MAP_VIEW => 'Map View',
        self::CONTACT_FORM => 'Contact Form',
        self::INDUSTRY => 'Industry',
        self::BADGE_HOSTING => 'Badge: Hosting',
        self::BADGE_DEVELOPMENT => 'Badge: Development',
        self::BADGE_DESIGN => 'Badge: Design',
        self::BADGE_CONSULTING => 'Badge: Consulting',
        self::SOCIAL_MEDIA_CHANNEL => 'Social Media Channel',
        self::ADDITIONAL_LOCATION => 'Additional Location',
        self::PROFILE_BUNDLE => 'Profile Bundle',
        self::PHOTO => 'Photo',
    ];
}
