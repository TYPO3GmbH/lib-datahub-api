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
final class LegalBody extends AbstractEnum
{
    public const TYPO3_ASSOCIATION = 't3assoc';
    public const TYPO3_COMPANY = 't3company';
    protected static array $optionNames = [
        self::TYPO3_ASSOCIATION => 'TYPO3 Association',
        self::TYPO3_COMPANY => 'TYPO3 Company',
    ];
}
