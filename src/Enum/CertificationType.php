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
final class CertificationType extends AbstractEnum
{
    public const TCCC = 'TCCC';
    public const TCCD = 'TCCD';
    public const TCCI = 'TCCI';
    public const TCCE = 'TCCE';
    protected static array $optionNames = [
        self::TCCC => 'TYPO3 CMS Certified Consultant',
        self::TCCD => 'TYPO3 CMS Certified Developer',
        self::TCCI => 'TYPO3 CMS Certified Integrator',
        self::TCCE => 'TYPO3 CMS Certified Editor',
    ];
}
