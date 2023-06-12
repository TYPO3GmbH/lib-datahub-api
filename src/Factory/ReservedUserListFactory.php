<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\ReservedUser;

/**
 * @method static array{entities: array<string, mixed>} responseToArray(ResponseInterface $response)
 *
 * @extends AbstractFactory<ReservedUser[]>
 */
class ReservedUserListFactory extends AbstractFactory
{
    /**
     * @param array{entities: array<string, mixed>} $list
     *
     * @return ReservedUser[]
     */
    public static function fromArray(array $list): array
    {
        return array_map(static function (array $data): ReservedUser {
            return ReservedUserFactory::fromArray($data);
        }, $list['entities']);
    }
}
