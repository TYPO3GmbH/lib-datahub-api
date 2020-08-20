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

    protected static array $optionNames = [
        self::LOGO => 'Logo',
        self::BACKLINK => 'Backlink',
        self::PROFILE_PAGE => 'Profile Page',
        self::MAP_VIEW => 'Map View',
        self::CONTACT_FORM => 'Contact Form',
    ];
}
