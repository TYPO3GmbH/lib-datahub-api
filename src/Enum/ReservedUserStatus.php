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
final class ReservedUserStatus extends AbstractEnum
{
    public const DELETION_IN_PROGRESS = 'DELETION_IN_PROGRESS';
    public const DELETED = 'DELETED';
    protected static array $optionNames = [
        self::DELETION_IN_PROGRESS => 'Deletion in progress',
        self::DELETED => 'Deleted',
    ];
}
