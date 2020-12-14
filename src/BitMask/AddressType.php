<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\BitMask;

class AddressType extends AbstractBitMask
{
    public const TYPE_INVOICE = 0x0001;  // 1
    public const TYPE_POSTAL = 0x0010;   // 16
    public const TYPE_DELIVERY = 0x0100; // 256
    public const TYPE_LOCATION = 0x1000; // 4096

    protected static array $bits = [
        self::TYPE_INVOICE => 'Invoice',
        self::TYPE_DELIVERY => 'Delivery',
        self::TYPE_POSTAL => 'Postal',
        self::TYPE_LOCATION => 'Location',
    ];
}
