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
final class ContentFormat extends AbstractEnum
{
    public const HTML = 'html';
    public const JSON = 'json';
    public const MARKDOWN = 'markdown';
    protected static array $optionNames = [
        self::HTML => 'HTML format',
        self::JSON => 'JSON format',
        self::MARKDOWN => 'Markdown format',
    ];
}
