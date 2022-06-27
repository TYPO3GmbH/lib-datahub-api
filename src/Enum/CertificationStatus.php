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
final class CertificationStatus extends AbstractEnum
{
    public const UNKNOWN = 'UNKNOWN';
    public const PREPARATION_REQUIRED = 'PREPARATION_REQUIRED';
    public const READY = 'READY';
    public const SCHEDULED = 'SCHEDULED';
    public const FINISHED = 'FINISHED';
    public const WAIT_RESULTS = 'WAIT_RESULTS';
    public const WAIT_PROCTOR = 'WAIT_PROCTOR';
    public const FAILED = 'FAILED';
    public const PASSED = 'PASSED';
    public const IN_PRINT = 'IN_PRINT';

    protected static array $optionNames = [
        self::UNKNOWN => 'Unknown',
        self::PREPARATION_REQUIRED => 'Preparation required',
        self::READY => 'Ready for the student',
        self::SCHEDULED => 'The exam is scheduled',
        self::FINISHED => 'The exam is finished',
        self::WAIT_RESULTS => 'The exam is waiting for results',
        self::WAIT_PROCTOR => 'The exam is waiting for proctoring results',
        self::FAILED => 'Failed',
        self::PASSED => 'Passed',
        self::IN_PRINT => 'In print',
    ];
}
