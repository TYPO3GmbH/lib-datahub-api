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
final class SubscriptionStatus extends AbstractEnum
{
    public const ACTIVE = 'active';
    public const PAST_DUE = 'past_due';
    public const UNPAID = 'unpaid';
    public const CANCEL_IN_PROGRESS = 'cancel_in_progress'; // This is no stripe status
    public const SWITCH_IN_PROGRESS = 'switch_in_progress'; // This is no stripe status
    public const CANCELED = 'canceled';
    public const INCOMPLETE = 'incomplete';
    public const INCOMPLETE_EXPIRED = 'incomplete_expired';
    public const TRIALING = 'trialing';

    /** @phpstan-var array<string,string>  */
    protected static array $optionNames = [
        self::ACTIVE => 'Active subscription',
        self::PAST_DUE => 'Past due payment',
        self::UNPAID => 'Unpaid payment',
        self::CANCEL_IN_PROGRESS => 'Cancel in progress',
        self::SWITCH_IN_PROGRESS => 'Switch in progress',
        self::CANCELED => 'Canceled payment',
        self::INCOMPLETE => 'Incomplete payment',
        self::INCOMPLETE_EXPIRED => 'Incomplete payment expired',
        self::TRIALING => 'Trialing payment',
    ];
}
