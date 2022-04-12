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
final class PaymentStatus extends AbstractEnum
{
    public const FAILED = 'failed';
    public const PAID = 'paid';
    public const PENDING = 'pending';
    public const DRAFT = 'draft';
    public const OPEN = 'open';
    public const UNCOLLECTIBLE = 'uncollectible';
    public const VOID = 'void';

    protected static array $optionNames = [
        self::FAILED => 'failed',
        self::PAID => 'paid',
        self::PENDING => 'pending',
        self::DRAFT => 'draft',
        self::OPEN => 'open',
        self::UNCOLLECTIBLE => 'uncollectible',
        self::VOID => 'void'
    ];
}
