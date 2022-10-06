<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\BitMask;

abstract class AbstractBitMask
{
    /**
     * @var array<int, string>
     */
    protected static array $bits = [];

    /**
     * @param int $types
     *
     * @return array<int, string>
     */
    public static function getLabelsFor(int $types): array
    {
        $strings = [];
        foreach (static::$bits as $value => $label) {
            if ($types & $value) {
                $strings[] = $label;
            }
        }

        return $strings;
    }

    public static function isValidValue(int $types): bool
    {
        if (0 > $types) {
            return false;
        }
        $matches = static::getLabelsFor($types);

        return 0 < count($matches);
    }

    /**
     * @param bool $withDescription
     *
     * @return array<int, string|int>
     */
    public static function getAvailableBits(bool $withDescription = false): array
    {
        return $withDescription ? static::$bits : array_keys(static::$bits);
    }
}
