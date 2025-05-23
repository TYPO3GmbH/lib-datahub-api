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
    public const PARTNER_PROGRAM = 'partner_program';
    public const PSL = 'psl';

    /**
     * @var array<string, class-string>
     */
    private static array $subTypeMap = [
        self::MEMBERSHIP => MembershipType::class,
        self::PARTNER_PROGRAM => PartnerProgramType::class,
        self::PSL => PSLType::class,
    ];
    protected static array $optionNames = [
        self::MEMBERSHIP => 'Membership',
        self::PARTNER_PROGRAM => 'Partner Program',
        self::PSL => 'Professional Service Listing',
    ];

    /**
     * @param string $type
     * @param bool   $withDescription
     *
     * @return array<int|string, string>|null
     */
    public static function getAllowedSubTypes(string $type, bool $withDescription = false): ?array
    {
        $subTypeEnumClass = self::$subTypeMap[$type] ?? null;
        if (null !== $subTypeEnumClass && is_a($subTypeEnumClass, AbstractEnum::class, true)) {
            return $subTypeEnumClass::getAvailableOptions($withDescription);
        }

        return null;
    }
}
