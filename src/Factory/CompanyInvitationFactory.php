<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use DateTime;
use T3G\DatahubApiLibrary\Entity\CompanyInvitation;

/**
 * @extends AbstractFactory<CompanyInvitation>
 */
class CompanyInvitationFactory extends AbstractFactory
{
    public static function fromArray(array $data): CompanyInvitation
    {
        return (new CompanyInvitation())
            ->setUsername($data['username'])
            ->setEmail($data['email'])
            ->setValidUntil(new DateTime($data['validUntil']))
            ->setInviteCode($data['inviteCode'])
            ->setRole($data['role']);
    }
}
