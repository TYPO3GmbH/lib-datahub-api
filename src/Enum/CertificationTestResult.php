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
final class CertificationTestResult extends AbstractEnum
{
    public const NO_RESULT = 'NO_RESULT';
    public const FAILED = 'FAILED';
    public const PASSED = 'PASSED';

    protected static array $optionNames = [
        self::NO_RESULT => 'No results yet',
        self::FAILED => 'Failed',
        self::PASSED => 'Passed',
    ];
}
