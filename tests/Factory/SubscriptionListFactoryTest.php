<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Entity\Subscription;
use T3G\DatahubApiLibrary\Enum\CertificationType;
use T3G\DatahubApiLibrary\Enum\MembershipType;
use T3G\DatahubApiLibrary\Enum\PartnerProgramType;
use T3G\DatahubApiLibrary\Enum\SubscriptionStatus;
use T3G\DatahubApiLibrary\Enum\SubscriptionType;
use T3G\DatahubApiLibrary\Factory\SubscriptionListFactory;

class SubscriptionListFactoryTest extends TestCase
{
    #[DataProvider('factoryDataProvider')]
    public function testFactory(array $data): void
    {
        $list = SubscriptionListFactory::fromArray($data);
        foreach ($list as $entity) {
            self::assertInstanceOf(Subscription::class, $entity);
        }
    }

    public static function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'entities' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'subscriptionIdentifier' => 'sub_aaaaa',
                            'subscriptionType' => SubscriptionType::MEMBERSHIP,
                            'subscriptionSubType' => MembershipType::BRONZE,
                            'subscriptionStatus' => SubscriptionStatus::ACTIVE,
                            'validUntil' => '2020-02-26T00:00:00+00:00',
                            'history' => 'husel pusel',
                            'payload' => ['baz' => 'benzer'],
                            'user' => [
                                'username' => 'oelie-boelie',
                                'firstName' => 'Oelie',
                                'lastName' => 'Boelie',
                                'status' => [
                                    'membership' => MembershipType::COMMUNITY,
                                    'certifications' => [CertificationType::TCCD],
                                ],
                            ],
                        ],
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'subscriptionIdentifier' => 'sub_aaaaa',
                            'subscriptionType' => SubscriptionType::MEMBERSHIP,
                            'subscriptionSubType' => MembershipType::BRONZE,
                            'subscriptionStatus' => SubscriptionStatus::ACTIVE,
                            'validUntil' => '2020-02-26T00:00:00+00:00',
                            'history' => 'husel pusel',
                            'payload' => ['baz' => 'benzer'],
                            'company' => [
                                'uuid' => '00000000-0000-0000-0000-000000000000',
                                'companyType' => 'AGENCY',
                                'title' => 'Aldi',
                                'email' => 'aldi-nice-things@example.com',
                                'vatId' => 'DE 123 456 789',
                                'status' => [
                                    'isFoundingPartner' => false,
                                    'membership' => MembershipType::GOLD,
                                    'partnerType' => PartnerProgramType::NONE,
                                ],
                            ],
                        ],
                    ],
                    'length' => 2,
                    'type' => 'App\\Entity\\SubscriptionList',
                ],
            ],
        ];
    }
}
