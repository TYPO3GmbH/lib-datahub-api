<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\EltsPlan;
use T3G\DatahubApiLibrary\Entity\EltsPlanList;
use T3G\DatahubApiLibrary\Enum\EltsPlanType;

/**
 * @extends AbstractFactory<EltsPlan>
 */
class EltsPlanFactory extends AbstractFactory
{
    /**
     * @param ResponseInterface $response
     *
     * @return EltsPlanList
     */
    public static function fromResponseDataCollection(ResponseInterface $response): EltsPlanList
    {
        $arrayResponse = self::responseToArray($response);
        $data = array_map(
            static fn (array $eltsPlanData) => self::fromArray($eltsPlanData),
            $arrayResponse['entities']
        );

        return new EltsPlanList($data);
    }

    /**
     * @param array<string, mixed> $data
     *
     * @return EltsPlan
     */
    public static function fromArray(array $data): EltsPlan
    {
        $eltsPlan = (new EltsPlan())
            ->setUuid($data['uuid'])
            ->setType($data['type'])
            ->setOwner($data['owner'])
            ->setVersion($data['version']);

        if (isset($data['order']) && is_array($data['order']) && [] !== $data['order']) {
            $eltsPlan->setOrder(OrderFactory::fromArray($data['order']));
        }
        if (isset($data['ownerData']) && is_array($data['ownerData']) && [] !== $data['ownerData']) {
            $eltsPlan->setOwnerData($data['ownerData']);
        }
        if (isset($data['validFrom'])) {
            $eltsPlan->setValidFrom($data['validFrom'] ? new \DateTime($data['validFrom']) : null);
        }
        if (isset($data['validTo'])) {
            $eltsPlan->setValidTo($data['validTo'] ? new \DateTime($data['validTo']) : null);
        }
        if (isset($data['title'])) {
            $eltsPlan->setTitle($data['title']);
        } else {
            $eltsPlan->setTitle(EltsPlanType::getName($data['type']));
        }
        if (isset($data['licenses'])) {
            $eltsPlan->setLicenses($data['licenses']);
        }

        foreach ($data['extendables'] ?? [] as $extendable) {
            $eltsPlan->addExtendable(EltsPlanExtendableFactory::fromArray($extendable));
        }
        foreach ($data['runtimes'] ?? [] as $runtime) {
            $eltsPlan->addRuntime(EltsRuntimeFactory::fromArray($runtime));
        }
        foreach ($data['instances'] ?? [] as $instance) {
            $eltsPlan->addInstance(EltsInstanceFactory::fromArray($instance));
        }
        foreach ($data['technicalContacts'] ?? [] as $technicalContact) {
            $eltsPlan->addTechnicalContact(TechnicalContactFactory::fromArray($technicalContact));
        }
        foreach ($data['releaseNotifications'] ?? [] as $releaseNotification) {
            $eltsPlan->addReleaseNotification(ReleaseNotificationFactory::fromArray($releaseNotification));
        }

        return $eltsPlan;
    }
}
