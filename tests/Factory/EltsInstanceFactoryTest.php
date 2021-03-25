<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\EltsInstanceFactory;

class EltsInstanceFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = EltsInstanceFactory::fromArray($data);
        self::assertEquals($data['uuid'], $entity->getUuid());
        self::assertEquals($data['name'], $entity->getName());
        self::assertEquals($data['owner'], $entity->getOwner());
        self::assertEquals($data['ownerData'], $entity->getOwnerData());
        self::assertEquals($data['eltsPlan']['uuid'], $entity->getEltsPlan()->getUuid());

        $releaseNotificationsCount = 0;
        if (isset($data['releaseNotifications'])) {
            $releaseNotificationsCount = count($data['releaseNotifications']);
        }
        self::assertCount($releaseNotificationsCount, $entity->getReleaseNotifications());

        $technicalContactsCount = 0;
        if (isset($data['technicalContacts'])) {
            $technicalContactsCount = count($data['technicalContacts']);
        }
        self::assertCount($technicalContactsCount, $entity->getTechnicalContacts());
    }

    public function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'name' => 'Wololo',
                    'owner' => 'user:max.muster',
                    'ownerData' => [
                        'title' => 'Max Muster',
                        'email' => 'max@example.com'
                    ],
                    'eltsPlan' => [
                        'uuid' => '11111111-1111-1111-1111-111111111111',
                        'owner' => 'organization:00000000-0000-0000-0000-000000000000',
                        'version' => '8.7',
                        'type' => 'agency',
                        'runtime' => '2-2',
                        'validFrom' => '2021-04-01T00:00:00+00:00',
                        'validTo' => '2022-03-31T00:00:00+00:00',
                        'order' => [
                        ],
                        'licenses' => null,
                        'releaseNotifications' => [
                            [
                                'uuid' => '33333333-3333-3333-3333-333333333333',
                                'name' => 'From Plan 2.1',
                                'email' => 'from-plan1@typo3.com',
                                'inherited' => true,
                                'owner' => 'organization:00000000-0000-0000-0000-000000000000',
                                'accepted' => false,
                            ],
                            [
                                'uuid' => '44444444-4444-4444-4444-444444444444',
                                'name' => 'From Plan 2.2',
                                'email' => 'from-plan2@typo3.com',
                                'inherited' => true,
                                'owner' => 'organization:00000000-0000-0000-0000-000000000000',
                                'accepted' => true,
                            ],
                        ],
                        'technicalContacts' => [
                            [
                                'uuid' => '44444444-4444-4444-4444-444444444444',
                                'firstName' => 'From Plan 1',
                                'lastName' => 'From Plan 1',
                                'email' => 'from-plan-1@typo3.com',
                                'accepted' => false,
                                'inherited' => true,
                                'username' => 'plan1_1',
                            ],
                            [
                                'uuid' => '55555555-5555-5555-5555-555555555555',
                                'firstName' => 'From Plan 2.2',
                                'lastName' => 'From PLan 2.2',
                                'email' => 'from-plan-2@example.com',
                                'accepted' => false,
                                'inherited' => true,
                                'username' => null,
                            ],
                        ],
                    ],
                    'releaseNotifications' => [
                        [
                            'uuid' => '33333333-3333-3333-3333-333333333333',
                            'name' => 'From Plan 2.1',
                            'email' => 'from-plan1@typo3.com',
                            'inherited' => true,
                            'owner' => 'organization:00000000-0000-0000-0000-000000000000',
                            'accepted' => false
                        ]
                    ],
                    'technicalContacts' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'username' => 'foo',
                            'firstName' => 'Foo',
                            'lastName' => 'Bar',
                            'email' => 'foo@bar.baz',
                            'accepted' => false,
                        ]
                    ]
                ],
            ],
        ];
    }
}
