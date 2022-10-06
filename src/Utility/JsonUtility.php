<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Utility;

class JsonUtility
{
    public static function decode(string $json): array
    {
        $content = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        return is_array($content) ? $content : [];
    }
}
