<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\EmployeeFactory;

class EmployeeFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     *
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = EmployeeFactory::fromArray($data);
        self::assertEquals($data['uuid'], $entity->getUuid());
        self::assertEquals($data['role'], $entity->getRole());
        if (null !== $data['leftAt']) {
            self::assertEquals($data['leftAt'], $entity->getLeftAt()->format(\DateTimeInterface::ATOM));
        } else {
            self::assertNull($entity->getLeftAt());
        }
        self::assertEquals($data['joinedAt'], $entity->getJoinedAt()->format(\DateTimeInterface::ATOM));

        if (isset($data['user'])) {
            self::assertEquals($data['user']['username'], $entity->getUser()->getUsername());
            self::assertEquals($data['user']['firstName'], $entity->getUser()->getFirstName());
            self::assertEquals($data['user']['lastName'], $entity->getUser()->getLastName());
        }
        if (isset($data['company'])) {
            self::assertEquals($data['company']['uuid'], $entity->getCompany()->getUuid());
            self::assertEquals($data['company']['title'], $entity->getCompany()->getTitle());
            self::assertEquals($data['company']['email'], $entity->getCompany()->getEmail());
            self::assertEquals($data['company']['vatId'], $entity->getCompany()->getVatId());
        }
    }

    public function factoryDataProvider(): array
    {
        return [
            'withUser' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'role' => 'OWNER',
                    'joinedAt' => '2020-02-26T00:00:00+00:00',
                    'leftAt' => null,
                    'user' => [
                        'username' => 'oelie-boelie',
                        'firstName' => 'Oelie',
                        'lastName' => 'Boelie',
                    ],
                ],
            ],
            'withCompany' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'role' => 'OWNER',
                    'joinedAt' => '2020-02-26T00:00:00+00:00',
                    'leftAt' => null,
                    'company' => [
                        'uuid' => '00000000-0000-0000-0000-000000000000',
                        'companyType' => 'AGENCY',
                        'title' => 'Aldi',
                        'email' => 'aldi-nice-things@example.com',
                        'vatId' => 'DE 123 456 789',
                    ],
                ],
            ],
            'withLeftAt' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'role' => 'OWNER',
                    'joinedAt' => '2020-02-26T00:00:00+00:00',
                    'leftAt' => '2020-05-26T00:00:00+00:00',
                    'company' => [
                        'uuid' => '00000000-0000-0000-0000-000000000000',
                        'companyType' => 'AGENCY',
                        'title' => 'Aldi',
                        'email' => 'aldi-nice-things@example.com',
                        'vatId' => 'DE 123 456 789',
                    ],
                ],
            ],
        ];
    }
}
