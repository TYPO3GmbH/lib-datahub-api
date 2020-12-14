<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\BitMask;

class EmailType extends AbstractBitMask
{
    public const PRIMARY = 0x0001; // 1
    public const BILLING = 0x0010; // 16
    public const VOTING = 0x0100;  // 256

    protected static array $bits = [
        self::PRIMARY => 'Primary',
        self::BILLING => 'Billing',
        self::VOTING => 'Voting',
    ];
}
