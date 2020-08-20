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
final class SubscriptionType extends AbstractEnum
{
    public const MEMBERSHIP = 'membership';
    public const PSL = 'psl';

    private static array $subTypeMap = [
        self::MEMBERSHIP => MembershipType::class,
        self::PSL => PSLType::class,
    ];

    protected static array $optionNames = [
        self::MEMBERSHIP => 'Membership',
        self::PSL => 'Professional Service Listing',
    ];

    public static function getAllowedSubTypes(string $subType, $withDescription = false): ?array
    {
        $subTypeEnumClass = self::$subTypeMap[$subType] ?? null;
        if (null !== $subTypeEnumClass) {
            return $subTypeEnumClass::getAvailableOptions($withDescription);
        }
        return null;
    }
}
