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
final class PrivacySettingType extends AbstractEnum
{
    public const PRIVATE = 'private';
    public const LOGGED_IN = 'logged-in';
    public const PUBLIC = 'public';
    protected static array $optionNames = [
        self::PRIVATE => 'Private',
        self::LOGGED_IN => 'Logged-in users',
        self::PUBLIC => 'Public',
    ];
}
