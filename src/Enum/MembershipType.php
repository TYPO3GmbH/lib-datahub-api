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
    public const HONORARY_MEMBER = 'HONORARY_MEMBER';
    public const HONORARY_PRESIDENT = 'HONORARY_PRESIDENT';
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
        self::HONORARY_MEMBER => 'Honorary Member',
        self::HONORARY_PRESIDENT => 'Honorary President',
        self::REDUCED_BRONZE => 'Bronze',
        self::REDUCED_SILVER => 'Silver',
        self::REDUCED_GOLD => 'Gold',
    ];

    /**
     * @var array<string, bool>
     */
    protected static array $isManageable = [
        self::NONE => true,
        self::COMMUNITY => true,
        self::BRONZE => true,
        self::SILVER => true,
        self::GOLD => true,
        self::PLATINUM => true,
        self::HONORARY_MEMBER => false,
        self::HONORARY_PRESIDENT => false,
        self::REDUCED_BRONZE => true,
        self::REDUCED_SILVER => true,
        self::REDUCED_GOLD => true,
    ];

    public static function isManageable(string $optionName): bool
    {
        return self::$isManageable[$optionName] ?? false;
    }
}
