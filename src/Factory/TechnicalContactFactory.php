<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\TechnicalContact;

class TechnicalContactFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): TechnicalContact
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    /**
     * @param array<string, string> $data
     * @return TechnicalContact
     */
    public static function fromArray(array $data): TechnicalContact
    {
        return (new TechnicalContact())
            ->setUuid($data['uuid'])
            ->setFirstName($data['firstName'])
            ->setLastName($data['lastName'])
            ->setEmail($data['email'])
            ->setUser($data['user'] ?? null);
    }
}
