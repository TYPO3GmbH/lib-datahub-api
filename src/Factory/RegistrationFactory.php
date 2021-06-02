<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use DateTime;
use T3G\DatahubApiLibrary\Entity\Registration;

/**
 * @extends AbstractFactory<Registration>
 */
class RegistrationFactory extends AbstractFactory
{
    public static function fromArray(array $data): Registration
    {
        return (new Registration())
            ->setFirstName($data['firstName'])
            ->setLastName($data['lastName'])
            ->setEmail($data['email'])
            ->setUsername($data['username'])
            ->setRegistrationCode($data['registrationCode'])
            ->setLocation($data['location'] ?? null)
            ->setValidUntil($data['validUntil'] ? new DateTime($data['validUntil']) : null);
    }
}
