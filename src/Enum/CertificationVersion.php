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
final class CertificationVersion extends AbstractEnum
{
    public const FOURTEEN = '14.3';
    public const THIRTEEN = '13.4';
    public const TWELVE = '12.4';
    public const ELEVEN = '11.5';
    public const TEN = '10.4';
    public const NINE = '9.5';
    public const EIGHT = '8.7';
    public const SEVEN = '7.6';
    public const SIX = '6.2';
    public const FOUR = '4.5';
    protected static array $optionNames = [
        self::FOURTEEN => 'v14.3 LTS',
        self::THIRTEEN => 'v13.4 LTS',
        self::TWELVE => 'v12.4 LTS',
        self::ELEVEN => 'v11.5 LTS',
        self::TEN => 'v10.4 LTS',
        self::NINE => 'v9.5 LTS',
        self::EIGHT => 'v8.7 LTS',
        self::SEVEN => 'v7.6 LTS',
        self::SIX => 'v6.2 LTS',
        self::FOUR => 'v4.5 LTS',
    ];
}
