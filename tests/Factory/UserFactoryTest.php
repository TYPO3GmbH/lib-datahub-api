<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\UserFactory;
use T3G\DatahubApiLibrary\Notification\IncompletePaymentNotification;

class UserFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = UserFactory::fromArray($data);
        $this->assertEquals($data['username'], $entity->getUsername());
        $this->assertEquals($data['firstName'], $entity->getFirstName());
        $this->assertEquals($data['lastName'], $entity->getLastName());
        $this->assertEquals($data['phone'], $entity->getPhone());
        $this->assertCount(count($data['addresses'] ?? []), $entity->getAddresses());
        $this->assertCount(count($data['links'] ?? []), $entity->getLinks());
        $this->assertCount(count($data['certifications'] ?? []), $entity->getCertifications());
        $this->assertCount(count($data['approvedDocuments'] ?? []), $entity->getApprovedDocuments());
        if (!empty($data['membership'])) {
            $this->assertEquals($data['membership']['subscriptionSubType'], $entity->getMembership()->getSubscriptionSubType());
        }
        $this->assertCount(count($data['subscriptions'] ?? []), $entity->getSubscriptions());
        if (!empty($data['notifications'])) {
            $this->assertInstanceOf($data['notifications'][0]['type'], $entity->getNotifications()[0]);
        }
    }

    public function factoryDataProvider(): array
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
                            'optIn' => '2020-12-16T10:13:26+00:00'
                        ]
                    ],
                    'phone' => '+31612345678'
                ]
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
                            'optIn' => '2020-12-16T10:13:26+00:00'
                        ]
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
                                'label' => 'Russia'
                            ],
                            'zip' => '1234 QZ',
                            'type' => 2,
                            'checksum' => '857f7bdf4322df6bffec0fbba1481f9169dbf8d2f779923ea48f1c0d1e2809d1',
                        ]
                    ],
                    'links' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'icon' => 'github',
                            'url' => 'https://github.com/oelie-boelie'
                        ]
                    ],
                    'certifications' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'type' => 'TCCI',
                            'version' => '10.4',
                            'status' => 'PASSED',
                            'examLocation' => 'Aldi',
                            'examDate' => '2020-02-26T00:00:00+00:00',
                            'proctoringLink' => 'https://example.com/00000000-0000-0000-0000-000000000000',
                            'examUrl' => 'https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000',
                        ]
                    ],
                    'examAccesses' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'voucher' => '00000000-0000-0000-0000-0000000000001',
                            'certificationType' => 'TCCI',
                            'certificationVersion' => '10.4',
                            'status' => 'READY',
                        ]
                    ],
                    'membership' => [
                        'uuid' => '00000000-0000-0000-0000-000000000000',
                        'subscriptionIdentifier' => 'sub_AAAAAAAAA',
                        'subscriptionType' => 'membership',
                        'subscriptionSubType' => 'SILVER',
                        'subscriptionStatus' => 'active',
                        'validUntil' => '2021-09-03T10:00:00+00:00',
                    ],
                    'subscriptions' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'subscriptionIdentifier' => 'sub_AAAAAAAAA',
                            'subscriptionType' => 'membership',
                            'subscriptionSubType' => 'SILVER',
                            'subscriptionStatus' => 'active',
                            'validUntil' => '2021-09-03T10:00:00+00:00',
                        ]
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
                                'phone' => null
                            ],
                        ]
                    ],
                    'notifications' => [
                        [
                            'company' => 'd6abf140-c946-474f-8e3a-2a55ea7bdd71',
                            'companyTitle' => 'Foo Company',
                            'subscription' => 'stripe:sub_I7xrK6SffVrwic:si_I7xrOvfj9FPO82',
                            'stripeLink' => 'https://foo.com/bar',
                            'type' => IncompletePaymentNotification::class,
                            'message' => 'Incomplete payment for company d6abf140-c946-474f-8e3a-2a55ea7bdd71'
                        ]
                    ]
                ]
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
                            'optIn' => '2020-12-16T10:13:26+00:00'
                        ]
                    ],
                    'phone' => null
                ]
            ]
        ];
    }
}
