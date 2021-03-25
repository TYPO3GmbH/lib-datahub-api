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
     * @param array<string, mixed> $data
     * @return TechnicalContact
     */
    public static function fromArray(array $data): TechnicalContact
    {
        $technicalContact = (new TechnicalContact())
            ->setUuid($data['uuid'])
            ->setFirstName($data['firstName'])
            ->setLastName($data['lastName'])
            ->setEmail($data['email'])
            ->setAccepted($data['accepted'])
            ->setUser($data['user'] ?? null);

        if (isset($data['eltsPlan']) && null !== $data['eltsPlan'] && is_array($data['eltsPlan'])) {
            $technicalContact->setEltsPlan(EltsPlanFactory::fromArray($data['eltsPlan']));
        }
        if (isset($data['eltsInstance']) && null !== $data['eltsInstance'] && is_array($data['eltsInstance'])) {
            $technicalContact->setEltsInstance(EltsInstanceFactory::fromArray($data['eltsInstance']));
        }

        return $technicalContact;
    }
}
