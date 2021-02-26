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
abstract class AbstractEnum
{
    /**
     * @var array<string, string>
     */
    protected static array $optionNames = [];

    public static function getName(?string $option): string
    {
        return static::$optionNames[$option] ?? ('Unknown option (' . $option . ')');
    }

    /**
     * @param bool $withDescription
     * @return array<int|string, string>
     */
    public static function getAvailableOptions(bool $withDescription = false): array
    {
        return $withDescription ? static::$optionNames : array_keys(static::$optionNames);
    }

    public static function isOption(string $option): bool
    {
        return isset(static::$optionNames[$option]);
    }
}
