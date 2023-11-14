<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Enum;

final class CompanyService extends AbstractEnum
{
    public const CONSULTING = 'CONSULTING';
    public const DESIGN = 'DESIGN';
    public const DEVELOPMENT = 'DEVELOPMENT';
    public const HOSTING = 'HOSTING';
    protected static array $optionNames = [
        self::CONSULTING => 'Consulting',
        self::DESIGN => 'Design',
        self::DEVELOPMENT => 'Development',
        self::HOSTING => 'Hosting',
    ];
}
