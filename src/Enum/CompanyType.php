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
final class CompanyType extends AbstractEnum
{
    public const AGENCY = 'AGENCY';
    public const FREELANCER = 'FREELANCER';
    public const HOSTER = 'HOSTER';
    public const OTHER = 'OTHER';
    public const UNIVERSITY = 'UNIVERSITY';

    protected static array $optionNames = [
        self::AGENCY => 'Agency',
        self::FREELANCER => 'Freelancer',
        self::HOSTER => 'Hoster',
        self::OTHER => 'Other',
        self::UNIVERSITY => 'University',
    ];
}
