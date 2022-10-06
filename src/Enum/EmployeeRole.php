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
final class EmployeeRole extends AbstractEnum
{
    public const OWNER = 'OWNER';
    public const MANAGER = 'MANAGER';
    public const EMPLOYEE = 'EMPLOYEE';
    protected static array $optionNames = [
        self::OWNER => 'Owner',
        self::MANAGER => 'Manager',
        self::EMPLOYEE => 'Employee',
    ];
}
