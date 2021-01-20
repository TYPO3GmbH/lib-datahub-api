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
class VoucherCodeType extends AbstractEnum
{
    public const EVENTS = 'EVENTS';
    public const CERTIFICATIONS = 'CERTIFICATIONS';

    protected static array $optionNames = [
        self::EVENTS => 'Events',
        self::CERTIFICATIONS => 'Certifications',
    ];
}
