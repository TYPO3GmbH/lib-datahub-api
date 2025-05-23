<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\Subscription;

/**
 * @method static array{entities: array<string, mixed>} responseToArray(ResponseInterface $response)
 *
 * @extends AbstractFactory<Subscription[]>
 */
class SubscriptionListFactory extends AbstractFactory
{
    /**
     * @param array{entities: array<string, mixed>} $list
     *
     * @return Subscription[]
     */
    public static function fromArray(array $list): array
    {
        return array_map(static function (array $data): Subscription {
            return SubscriptionFactory::fromArray($data);
        }, $list['entities']);
    }
}
