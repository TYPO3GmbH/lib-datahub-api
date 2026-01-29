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
use T3G\DatahubApiLibrary\Enum\CertificationType;
use T3G\DatahubApiLibrary\Enum\MembershipType;
use T3G\DatahubApiLibrary\Factory\UserFactory;

class UserFactoryTest extends TestCase
{
    #[DataProvider('factoryDataProvider')]
    public function testFactory(array $data): void
    {
        $entity = UserFactory::fromArray($data);
        self::assertEquals($data['username'], $entity->getUsername());
        self::assertEquals($data['firstName'], $entity->getFirstName());
        self::assertEquals($data['lastName'], $entity->getLastName());
        if (isset($data['phone'])) {
            self::assertEquals($data['phone'], $entity->getPhone());
        }
        self::assertCount(count($data['addresses'] ?? []), $entity->getAddresses());
        self::assertCount(count($data['links'] ?? []), $entity->getLinks());
        self::assertCount(count($data['certifications'] ?? []), $entity->getCertifications());
        self::assertCount(count($data['approvedDocuments'] ?? []), $entity->getApprovedDocuments());
        if (!empty($data['membership'])) {
            self::assertEquals($data['membership']['subscriptionSubType'], $entity->getMembership()->getSubscriptionSubType());
        }
        self::assertCount(count($data['subscriptions'] ?? []), $entity->getSubscriptions());
        self::assertEquals($data['emailAddresses'][0]['email'], $entity->getPrimaryEmail());
        self::assertSame($data['status'], $entity->getStatus());
    }

    public static function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'username' => 'oelie-boelie',
                    'firstName' => 'Oelie',
                    'lastName' => 'Boelie',
                    'emailAddresses' => [
                        [
                            'uuid' => '311b4cf9-761f-4fb3-b1e4-6b23e4a91c0b',
                            'email' => 'oelie@boelie.nl',
                            'type' => 273,
                            'optIn' => '2020-12-16T10:13:26+00:00',
                        ],
                    ],
                    'phone' => '+31612345678',
                    'status' => [
                        'membership' => MembershipType::COMMUNITY,
                        'certifications' => [CertificationType::TCCD],
                    ],
                ],
            ],
            'allValuesSet and relations' => [
                'data' => [
                    'username' => 'oelie-boelie',
                    'firstName' => 'Oelie',
                    'lastName' => 'Boelie',
                    'emailAddresses' => [
                        [
                            'uuid' => '311b4cf9-761f-4fb3-b1e4-6b23e4a91c0b',
                            'email' => 'oelie@boelie.nl',
                            'type' => 273,
                            'optIn' => '2020-12-16T10:13:26+00:00',
                        ],
                    ],
                    'phone' => '+31612345678',
                    'addresses' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'title' => 'test address',
                            'firstName' => 'Oelie',
                            'lastName' => 'Boelie',
                            'additionalAddressLine1' => '',
                            'additionalAddressLine2' => '',
                            'street' => 'Teststreet 1234',
                            'city' => 'Dorf und so',
                            'country' => [
                                'iso' => 'RU',
                                'iso3' => 'RUS',
                                'label' => 'Russia',
                            ],
                            'zip' => '1234 QZ',
                            'type' => 2,
                            'checksum' => '857f7bdf4322df6bffec0fbba1481f9169dbf8d2f779923ea48f1c0d1e2809d1',
                        ],
                    ],
                    'links' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'type' => 'github',
                            'value' => 'oelie-boelie',
                            'highlight' => true,
                        ],
                    ],
                    'certifications' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'type' => 'TCCI',
                            'version' => '10.4',
                            'auditType' => 'PRESENCE',
                            'status' => 'PASSED',
                            'examLocation' => 'Aldi',
                            'examDate' => '2020-02-26T00:00:00+00:00',
                            'ndaSigned' => true,
                            'rulesAccepted' => true,
                            'proctoringLink' => 'https://example.com/00000000-0000-0000-0000-000000000000',
                            'examUrl' => 'https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000',
                        ],
                    ],
                    'examAccesses' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'voucher' => '00000000-0000-0000-0000-0000000000001',
                            'certificationType' => 'TCCI',
                            'certificationVersion' => '10.4',
                            'status' => 'READY',
                        ],
                    ],
                    'membership' => [
                        'uuid' => '00000000-0000-0000-0000-000000000000',
                        'subscriptionIdentifier' => 'sub_AAAAAAAAA',
                        'subscriptionType' => 'membership',
                        'subscriptionSubType' => 'SILVER',
                        'subscriptionStatus' => 'active',
                        'validUntil' => '2021-09-03T10:00:00+00:00',
                        'nextCancellationPossibleAt' => '2022-09-03T10:00:00+00:00',
                    ],
                    'subscriptions' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'subscriptionIdentifier' => 'sub_AAAAAAAAA',
                            'subscriptionType' => 'membership',
                            'subscriptionSubType' => 'SILVER',
                            'subscriptionStatus' => 'active',
                            'validUntil' => '2021-09-03T10:00:00+00:00',
                            'nextCancellationPossibleAt' => '2022-09-03T10:00:00+00:00',
                        ],
                    ],
                    'approvedDocuments' => [
                        [
                            'documentIdentifier' => 'foo',
                            'documentVersion' => '1.0.0',
                            'approveDate' => '2020-02-26T00:00:00+00:00',
                            'user' => [
                                'username' => 'oelie-boelie',
                                'firstName' => 'Oelie',
                                'lastName' => 'Boelie',
                                'email' => 'oelie@boelie.nl',
                                'phone' => null,
                                'status' => [
                                    'membership' => MembershipType::SILVER,
                                    'certifications' => [CertificationType::TCCI],
                                ],
                            ],
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::SILVER,
                        'certifications' => [CertificationType::TCCI],
                    ],
                ],
            ],
            'nullPhone' => [
                'data' => [
                    'username' => 'oelie-boelie',
                    'firstName' => 'Oelie',
                    'lastName' => 'Boelie',
                    'emailAddresses' => [
                        [
                            'uuid' => '311b4cf9-761f-4fb3-b1e4-6b23e4a91c0b',
                            'email' => 'oelie@boelie.nl',
                            'type' => 273,
                            'optIn' => '2020-12-16T10:13:26+00:00',
                        ],
                    ],
                    'phone' => null,
                    'status' => [
                        'membership' => MembershipType::COMMUNITY,
                        'certifications' => [CertificationType::TCCD],
                    ],
                ],
            ],
            'user-resource-primary' => [
                'data' => [
                    'username' => 'oelie-boelie',
                    'firstName' => 'Oelie',
                    'lastName' => 'Boelie',
                    'emailAddresses' => [
                        [
                            'uuid' => '311b4cf9-761f-4fb3-b1e4-6b23e4a91c0b',
                            'email' => 'oelie@boelie.nl',
                            'type' => 273,
                            'optIn' => '2020-12-16T10:13:26+00:00',
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::COMMUNITY,
                        'certifications' => [CertificationType::TCCD],
                    ],
                ],
            ],
        ];
    }
}
