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
final class EltsPlanType extends AbstractEnum
{
    public const SINGLE = 'single';
    public const PRO = 'pro';
    public const AGENGY = 'agency';

    /**
     * @var array<string, string>
     */
    protected static array $optionNames = [
        self::SINGLE => 'Single Plan',
        self::PRO => 'Pro Plan',
        self::AGENGY => 'Agency Plan',
    ];
}
