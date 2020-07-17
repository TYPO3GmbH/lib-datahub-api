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
final class MembershipType extends AbstractEnum
{
    public const ACADEMIC = 'ACADEMIC';
    public const BRONZE = 'BRONZE';
    public const COMMUNITY = 'COMMUNITY';
    public const GOLD = 'GOLD';
    public const PLATINUM = 'PLATINUM';
    public const SILVER = 'SILVER';

    protected static array $optionNames = [
        self::ACADEMIC => 'Academic',
        self::BRONZE => 'Bronze',
        self::COMMUNITY => 'Community',
        self::GOLD => 'Gold',
        self::PLATINUM => 'Platinum',
        self::SILVER => 'Silver',
    ];
}
