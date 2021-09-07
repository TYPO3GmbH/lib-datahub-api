<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Service;

class SecurityService
{
    /**
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    public static function anonymizeSensitiveData(array $data): array
    {
        $sensitiveKeys = ['password', 'token'];
        foreach ($data as $key => &$datum) {
            if (is_string($key)) {
                $key = strtolower($key);
            }
            if (is_array($datum)) {
                $datum = self::anonymizeSensitiveData($datum);
            } elseif (in_array($key, $sensitiveKeys, true)) {
                $datum = '**********';
            }
        }
        return $data;
    }
}
