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
final class CertificationProctoringStatus extends AbstractEnum
{
    public const PENDING = 'pending';
    public const FULFILLED = 'fulfilled';
    public const CANCELLED = 'cancelled';
    public const SCHEDULED = 'scheduled';
    public const VOIDED = 'voided';
    public const STALE = 'stale';
    public const RESCHEDULED = 'rescheduled';
    protected static array $optionNames = [
        self::PENDING => 'Pending',
        self::FULFILLED => 'Fulfilled',
        self::CANCELLED => 'Cancelled',
        self::SCHEDULED => 'Scheduled',
        self::VOIDED => 'Voided',
        self::STALE => 'Stale',
        self::RESCHEDULED => 'Rescheduled',
    ];
}
