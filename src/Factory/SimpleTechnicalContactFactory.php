<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\SimpleTechnicalContact;

class SimpleTechnicalContactFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): SimpleTechnicalContact
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    /**
     * @param array<string, string> $data
     * @return SimpleTechnicalContact
     */
    public static function fromArray(array $data): SimpleTechnicalContact
    {
        return (new SimpleTechnicalContact())
            ->setUuid($data['uuid'])
            ->setFirstName($data['firstName'])
            ->setLastName($data['lastName'])
            ->setEmail($data['email']);
    }
}
