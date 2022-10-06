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
final class CertificationAuditType extends AbstractEnum
{
    public const PROCTORU = 'PROCTORU';
    public const PRESENCE = 'PRESENCE';
    public const UNKNOWN = 'UNKNOWN';
    protected static array $optionNames = [
        self::PROCTORU => 'ProctorU',
        self::PRESENCE => 'Presence',
        self::UNKNOWN => 'Unknown',
    ];
}
