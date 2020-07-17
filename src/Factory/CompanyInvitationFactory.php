<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use DateTime;
use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\CompanyInvitation;

class CompanyInvitationFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): CompanyInvitation
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

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
