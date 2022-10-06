<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\EmailAddress;

/**
 * @extends AbstractFactory<EmailAddress>
 */
class EmailAddressFactory extends AbstractFactory
{
    /**
     * @param array<string, mixed> $data
     *
     * @return EmailAddress
     *
     * @throws \Exception
     */
    public static function fromArray(array $data): EmailAddress
    {
        $emailAddress = (new EmailAddress())
            ->setUuid($data['uuid'])
            ->setEmail($data['email'])
            ->setType($data['type']);
        if (isset($data['optIn'])) {
            $emailAddress->setOptIn(new \DateTimeImmutable($data['optIn']));
        }

        return $emailAddress;
    }
}
