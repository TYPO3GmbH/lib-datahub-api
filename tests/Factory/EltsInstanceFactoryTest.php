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
                        ]
                    ]
                ],
            ],
        ];
    }
}
