<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\User;

/**
 * @extends AbstractFactory<User>
 */
class UserFactory extends AbstractFactory
{
    public static function fromArray(array $data): User
    {
        $user = (new User())
            ->setUserName($data['username'])
            ->setLastName($data['lastName'] ?? null)
            ->setFirstName($data['firstName'] ?? null)
            ->setPhone($data['phone'] ?? null)
            ->setSlackId($data['slackId'] ?? null)
            ->setDiscordId($data['discordId'] ?? null)
            ->setGravatarString($data['gravatarString'] ?? null)
            ->setStatus($data['status'])
            ->setTitle($data['title'] ?? null)
            ->setBio($data['bio'] ?? null)
            ->setPrivacySettings(PrivacySettingsFactory::fromArray($data['privacySettings'] ?? []));

        foreach ($data['addresses'] ?? [] as $address) {
            $user->addAddress(AddressFactory::fromArray($address));
        }
        foreach ($data['links'] ?? [] as $link) {
            $user->addLink(LinkFactory::fromArray($link));
        }
        foreach ($data['emailAddresses'] ?? [] as $emailAddress) {
            $user->addEmailAddress(EmailAddressFactory::fromArray($emailAddress));
        }
        foreach ($data['orders'] ?? [] as $order) {
            $user->addOrder(OrderFactory::fromArray($order));
        }
        foreach ($data['subscriptions'] ?? [] as $subscription) {
            $user->addSubscription(SubscriptionFactory::fromArray($subscription));
        }
        foreach ($data['notifications'] ?? [] as $notification) {
            $user->addNotification(NotificationFactory::fromArray($notification));
        }
        foreach ($data['certifications'] ?? [] as $certification) {
            $user->addCertification(CertificationFactory::fromArray($certification));
        }
        foreach ($data['companies'] ?? [] as $company) {
            $user->addCompany(CompanyFactory::fromArray($company));
        }
        foreach ($data['examAccesses'] ?? [] as $examAccess) {
            $user->addExamAccess(ExamAccessFactory::fromArray($examAccess));
        }
        if (isset($data['membership'])) {
            $user->setMembership(SubscriptionFactory::fromArray($data['membership']));
        }
        foreach ($data['approvedDocuments'] ?? [] as $approvedDocument) {
            $user->addApprovedDocument(ApprovedDocumentFactory::fromArray($approvedDocument));
        }
        foreach ($data['voucherCodes'] ?? [] as $voucherCode) {
            $user->addVoucherCode(VoucherCodeFactory::fromArray($voucherCode));
        }
        foreach ($data['eltsPlans'] ?? [] as $eltsPlan) {
            $user->addEltsPlan(EltsPlanFactory::fromArray($eltsPlan));
        }
        foreach ($data['eltsAccessTokens'] ?? [] as $eltsAccessToken) {
            $user->addEltsAccessToken(EltsAccessTokenFactory::fromArray($eltsAccessToken));
        }
        foreach ($data['eltsPublicKeys'] ?? [] as $eltsPublicKey) {
            $user->addEltsGitPublicKey(EltsGitPublicKeyFactory::fromArray($eltsPublicKey));
        }

        return $user;
    }
}
