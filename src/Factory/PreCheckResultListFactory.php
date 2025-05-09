<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\PreCheckResult;

/**
 * @method static array{entities: array<string, mixed>} responseToArray(ResponseInterface $response)
 *
 * @extends AbstractFactory<PreCheckResult[]>
 */
class PreCheckResultListFactory extends AbstractFactory
{
    /**
     * @param array{entities: array<string, mixed>} $list
     *
     * @return PreCheckResult[]
     */
    public static function fromArray(array $list): array
    {
        return array_map(static function (array $data): PreCheckResult {
            return PreCheckResultFactory::fromArray($data);
        }, $list['entities']);
    }
}
