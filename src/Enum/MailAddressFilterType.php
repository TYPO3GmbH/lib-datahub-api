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
final class MailAddressFilterType extends AbstractEnum
{
    public const ALLOWED_TLD = 'ALLOWED_TLD';
    public const DENIED_DOMAIN = 'DENIED_DOMAIN';
    public const ALLOWED_DOMAIN = 'ALLOWED_DOMAIN';

    protected static array $optionNames = [
        self::ALLOWED_TLD => 'allowed TLD',
        self::DENIED_DOMAIN => 'denied domain',
        self::ALLOWED_DOMAIN => 'allowed domain'
    ];
}
