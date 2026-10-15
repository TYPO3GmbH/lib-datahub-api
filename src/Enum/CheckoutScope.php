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
final class CheckoutScope extends AbstractEnum
{
    public const ELTS = 'elts';
    public const CERTIFICATION = 'certification';
    public const MEMBERSHIP = 'membership';
    public const SUITE = 'suite';
    public const SIMPLE_PRODUCT = 'simple_product';
    protected static array $optionNames = [
        self::ELTS => 'ELTS',
        self::CERTIFICATION => 'Certification',
        self::MEMBERSHIP => 'Memberships',
        self::SUITE => 'TYPO3 Suite',
        self::SIMPLE_PRODUCT => 'Simple Product',
    ];
}
