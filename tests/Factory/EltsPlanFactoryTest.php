<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Enum\EltsPlanType;
use T3G\DatahubApiLibrary\Factory\EltsPlanFactory;

class EltsPlanFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = EltsPlanFactory::fromArray($data);

        self::assertEquals($data['uuid'], $entity->getUuid());
        self::assertEquals($data['version'], $entity->getVersion());
        self::assertEquals($data['type'], $entity->getType());
        self::assertEquals($data['runtime'], $entity->getRuntime());
        $data['validFrom'] = $data['validFrom'] ?? null;
        self::assertEquals($data['validFrom'] ? new \DateTime($data['validFrom']) : null, $entity->getValidFrom());
        $data['validTo'] = $data['validTo'] ?? null;
        self::assertEquals($data['validTo'] ? new \DateTime($data['validTo']) : null, $entity->getValidTo());
        $instanceCount = 0;
        if (isset($data['instances'])) {
            $instanceCount = count($data['instances']);
        }
        self::assertEquals($data['title'] ?? EltsPlanType::getName($data['type']), $entity->getTitle());
        self::assertCount($instanceCount, $entity->getInstances());

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
        self::assertEquals(isset($data['licenses']) ? $data['licenses'] : 0, $entity->getLicenses());
    }

    public function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'version' => '8.7',
                    'type' => 'agency',
                    'title' => 'Agency Plan',
                    'runtime' => '1-3',
                    'validFrom' => '2020-04-01T00:00:00+00:00',
                    'validTo' => '2023-03-31T00:00:00+00:00',
                    'licenses' => null,
                    'instances' => [
                        [
                            'uuid' => 'add4c176-5fda-4b02-a877-ca3f4d48ca3f',
                            'name' => 'Wololo',
                            'technicalContacts' => [],
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
                            'uuid' => '44444444-4444-4444-4444-444444444444',
                            'firstName' => 'From Plan 1',
                            'lastName' => 'From Plan 1',
                            'email' => 'from-plan-1@typo3.com',
                            'accepted' => false,
                            'inherited' => true,
                            'username' => 'plan1_1'
                        ]
                    ]
                ],
            ],
            'minimum' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'version' => '8.7',
                    'type' => 'agency',
                    'runtime' => '1-3',
                ],
            ],
        ];
    }
}
