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
final class PartnerProgramType extends AbstractEnum
{
    public const NONE = 'NONE';
    public const SOLUTION = 'SOLUTION';
    public const TECHNOLOGY = 'TECHNOLOGY';
    public const CONSULTANT = 'CONSULTANT';
    protected static array $optionNames = [
        self::NONE => 'None',
        self::SOLUTION => 'Solution',
        self::TECHNOLOGY => 'Technology',
        self::CONSULTANT => 'Consultant',
    ];

    /**
     * @var array<string, float>
     */
    protected static array $optionWeights = [
        self::NONE => 0.0,
        self::CONSULTANT => 0.1,
        self::SOLUTION => 0.2,
        self::TECHNOLOGY => 0.45,
    ];

    public static function getWeight(?string $option): float
    {
        return self::$optionWeights[$option] ?? 0.0;
    }
}
