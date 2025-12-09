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
    public const ACADEMIC = 'ACADEMIC';
    public const AGENCY = 'AGENCY';
    public const ECOMMERCE = 'ECOMMERCE';
    public const FREELANCER = 'FREELANCER';
    public const HOSTER = 'HOSTER';
    public const INDUSTRY = 'INDUSTRY';
    public const NGO = 'NGO';
    public const OTHER = 'OTHER';
    public const PUBLIC_SECTOR = 'PUBLIC_SECTOR';
    protected static array $optionNames = [
        self::ACADEMIC => 'Academic',
        self::AGENCY => 'Agency',
        self::ECOMMERCE => 'E-Commerce',
        self::FREELANCER => 'Freelancer',
        self::HOSTER => 'Hosting Provider',
        self::INDUSTRY => 'Industry',
        self::NGO => 'NGO',
        self::OTHER => 'Other',
        self::PUBLIC_SECTOR => 'Public Sector',
    ];
}
