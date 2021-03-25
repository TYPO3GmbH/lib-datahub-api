<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\EltsInstance;
use T3G\DatahubApiLibrary\Entity\EltsInstanceList;

class EltsInstanceFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): EltsInstance
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }
    /**
     * @param ResponseInterface $response
     * @return EltsInstanceList
     */
    public static function fromResponseDataCollection(ResponseInterface $response): EltsInstanceList
    {
        $arrayResponse = self::responseToArray($response);
        $data = array_map(
            static fn (array $eltsInstanceData) => self::fromArray($eltsInstanceData),
            $arrayResponse['entities']
        );
        return new EltsInstanceList($data);
    }

    /**
     * @param array<string, mixed> $data
     * @return EltsInstance
     */
    public static function fromArray(array $data): EltsInstance
    {
        $eltsInstance = (new EltsInstance())
            ->setUuid($data['uuid'])
            ->setName($data['name'])
            ->setOwner($data['owner']);

        if (isset($data['eltsPlan']) && is_array($data['eltsPlan'])) {
            $eltsInstance->setEltsPlan(EltsPlanFactory::fromArray($data['eltsPlan']));
        }
        foreach ($data['technicalContacts'] ?? [] as $technicalContact) {
            $eltsInstance->addTechnicalContact(TechnicalContactFactory::fromArray($technicalContact));
        }
        foreach ($data['releaseNotifications'] ?? [] as $releaseNotification) {
            $eltsInstance->addReleaseNotification(ReleaseNotificationFactory::fromArray($releaseNotification));
        }

        return $eltsInstance;
    }
}
