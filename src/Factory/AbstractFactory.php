<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;

abstract class AbstractFactory
{
    /**
     * @param string $data
     * @return array<string, mixed>
     * @throws \JsonException
     */
    protected static function jsonDecode(string $data): array
    {
        return json_decode($data, true, 512, JSON_THROW_ON_ERROR);
    }

    protected static function responseToArray(ResponseInterface $response): array
    {
        return self::jsonDecode((string)$response->getBody());
    }

    abstract public static function fromResponse(ResponseInterface $response);

    /**
     * @param array<string, mixed> $data
     * @return mixed
     */
    abstract public static function fromArray(array $data);
}
