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
final class LicenseProduct extends AbstractEnum
{
    public const ELTS = 'ELTS';
    public const SUITE = 'SUITE';
    protected static array $optionNames = [
        self::ELTS => 'ELTS',
        self::SUITE => 'TYPO3 Suite',
    ];
}
