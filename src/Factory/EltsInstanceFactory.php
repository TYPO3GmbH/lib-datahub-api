<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\EltsInstance;

class EltsInstanceFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): EltsInstance
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    /**
     * @param array<string, mixed> $data
     * @return EltsInstance
     */
    public static function fromArray(array $data): EltsInstance
    {
        $eltsInstance = (new EltsInstance())
            ->setUuid($data['uuid'])
            ->setName($data['name']);

        foreach ($data['simpleTechnicalContacts'] ?? [] as $simpleTechnicalContact) {
            $eltsInstance->addSimpleTechnicalContact(SimpleTechnicalContactFactory::fromArray($simpleTechnicalContact));
        }

        foreach ($data['technicalContacts'] ?? [] as $technicalContact) {
            $eltsInstance->addTechnicalContact(UserFactory::fromArray($technicalContact));
        }

        return $eltsInstance;
    }
}
