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
    public const NONE = 'NONE';
    public const COMMUNITY = 'COMMUNITY';
    public const BRONZE = 'BRONZE';
    public const SILVER = 'SILVER';
    public const GOLD = 'GOLD';
    public const PLATINUM = 'PLATINUM';
    public const REDUCED_BRONZE = 'REDUCED_BRONZE';
    public const REDUCED_SILVER = 'REDUCED_SILVER';
    public const REDUCED_GOLD = 'REDUCED_GOLD';
    protected static array $optionNames = [
        self::NONE => 'None',
        self::COMMUNITY => 'Community',
        self::BRONZE => 'Bronze',
        self::SILVER => 'Silver',
        self::GOLD => 'Gold',
        self::PLATINUM => 'Platinum',
        self::REDUCED_BRONZE => 'Bronze',
        self::REDUCED_SILVER => 'Silver',
        self::REDUCED_GOLD => 'Gold',
    ];
}
