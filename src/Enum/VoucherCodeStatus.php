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
class VoucherCodeStatus extends AbstractEnum
{
    public const NEW = 'NEW';
    public const CHARGED = 'CHARGED';
    public const USED = 'USED';
    public const EXPIRED = 'EXPIRED';
    protected static array $optionNames = [
        self::NEW => 'New',
        self::CHARGED => 'Charged',
        self::USED => 'Used',
        self::EXPIRED => 'Expired',
    ];
}
