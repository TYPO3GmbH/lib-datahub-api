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
final class ExamAccessStatus extends AbstractEnum
{
    public const READY = 'READY';
    public const EXPIRED = 'EXPIRED';
    public const USED = 'USED';

    protected static array $optionNames = [
        self::READY => 'Ready to use',
        self::EXPIRED => 'Expired',
        self::USED => 'Voucher used',
    ];
}
