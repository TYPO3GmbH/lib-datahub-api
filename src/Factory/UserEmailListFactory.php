<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\UserEmail;

/**
 * @method static array{entities: array<string, mixed>} responseToArray(ResponseInterface $response)
 */
class UserEmailListFactory extends AbstractFactory
{
    /**
     * @param ResponseInterface $response
     * @return UserEmail[]
     */
    public static function fromResponse(ResponseInterface $response): array
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    /**
     * @param array{entities: array<string, mixed>} $list
     * @return UserEmail[]
     */
    public static function fromArray(array $list): array
    {
        return array_map(static function (array $data): UserEmail {
            return UserEmailFactory::fromArray($data);
        }, $list['entities']);
    }
}
