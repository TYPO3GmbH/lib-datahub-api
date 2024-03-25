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
final class YattaOrderType extends AbstractEnum
{
    public const ELTS_ORDER = 'ELTS_ORDER';
    public const ELTS_PROLONG = 'ELTS_PROLONG';
    protected static array $optionNames = [
        self::ELTS_ORDER => 'ELTS Order',
        self::ELTS_PROLONG => 'ELTS Prolonging',
    ];
}
