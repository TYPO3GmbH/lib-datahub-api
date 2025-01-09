<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Enum;

use T3G\DatahubApiLibrary\Entity\PrivacySettingsScope\PublicProfileScope;

/**
 * @codeCoverageIgnore No need to test this ...
 */
final class PrivacySettingScope extends AbstractEnum
{
    public const PUBLIC_PROFILE = PublicProfileScope::IDENTIFIER;
    protected static array $optionNames = [
        self::PUBLIC_PROFILE => 'Public Profile',
    ];
}
