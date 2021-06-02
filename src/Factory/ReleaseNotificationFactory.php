<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\ReleaseNotification;

/**
 * @extends AbstractFactory<ReleaseNotification>
 */
class ReleaseNotificationFactory extends AbstractFactory
{
    /**
     * @param array<string, mixed> $data
     * @return ReleaseNotification
     */
    public static function fromArray(array $data): ReleaseNotification
    {
        $releaseNotification = (new ReleaseNotification())
            ->setUuid($data['uuid'])
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setAccepted($data['accepted']);

        if (isset($data['inherited'])) {
            $releaseNotification->setInherited($data['inherited']);
        }
        if (isset($data['eltsPlan']) && null !== $data['eltsPlan'] && is_array($data['eltsPlan'])) {
            $releaseNotification->setEltsPlan(EltsPlanFactory::fromArray($data['eltsPlan']));
        }
        if (isset($data['eltsInstance']) && null !== $data['eltsInstance'] && is_array($data['eltsInstance'])) {
            $releaseNotification->setEltsInstance(EltsInstanceFactory::fromArray($data['eltsInstance']));
        }
        return $releaseNotification;
    }
}
