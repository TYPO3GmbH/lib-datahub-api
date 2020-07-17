<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\User;

class UserFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): User
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    public static function fromArray(array $data): User
    {
        $user = (new User())
            ->setUserName($data['username'])
            ->setLastName($data['lastName'] ?? null)
            ->setFirstName($data['firstName'] ?? null)
            ->setEmail($data['email'] ?? null)
            ->setPhone($data['phone'] ?? null)
            ->setSlackId($data['slackId'] ?? null)
            ->setDiscordId($data['discordId'] ?? null)
            ->setGravatarString($data['gravatarString'] ?? null);

        foreach ($data['addresses'] ?? [] as $address) {
            $user->addAddress(AddressFactory::fromArray($address));
        }
        foreach ($data['links'] ?? [] as $link) {
            $user->addLink(LinkFactory::fromArray($link));
        }
        foreach ($data['orders'] ?? [] as $order) {
            $user->addOrder(OrderFactory::fromArray($order));
        }
        foreach ($data['certifications'] ?? [] as $certification) {
            $user->addCertification(CertificationFactory::fromArray($certification));
        }
        foreach ($data['examAccesses'] ?? [] as $examAccess) {
            $user->addExamAccess(ExamAccessFactory::fromArray($examAccess));
        }
        if (isset($data['membership'])) {
            $user->setMembership(MembershipFactory::fromArray($data['membership']));
        }
        foreach ($data['approvedDocuments'] ?? [] as $approvedDocument) {
            $user->addApprovedDocument(ApprovedDocumentFactory::fromArray($approvedDocument));
        }

        return $user;
    }
}
