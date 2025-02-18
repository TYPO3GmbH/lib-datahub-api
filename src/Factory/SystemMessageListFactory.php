<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\SystemMessage;
use T3G\DatahubApiLibrary\Entity\SystemMessageList;

/**
 * @extends AbstractFactory<SystemMessage>
 */
class SystemMessageListFactory extends AbstractFactory
{
    public static function fromResponseDataCollection(ResponseInterface $response): SystemMessageList
    {
        $arrayResponse = self::responseToArray($response);
        /** @var array<array{uuid: string, title?: ?string, message?: ?string, createdAt?: ?string, active?: ?bool}> $data */
        $data = array_map(
            static fn (array $systemMessageData) => self::fromArray($systemMessageData),
            $arrayResponse['entities']
        );

        return new SystemMessageList($data);
    }

    /**
     * @param array{uuid: string, title?: ?string, message?: ?string, createdAt?: ?string, active?: ?bool} $data
     */
    public static function fromArray(array $data): SystemMessage
    {
        return SystemMessageFactory::fromArray($data);
    }
}
