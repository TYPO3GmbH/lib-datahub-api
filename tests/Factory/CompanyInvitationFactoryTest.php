<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\CompanyInvitationFactory;

class CompanyInvitationFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     *
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = CompanyInvitationFactory::fromArray($data);
        self::assertEquals($data['username'], $entity->getUsername());
        self::assertEquals($data['email'], $entity->getEmail());
        self::assertEquals($data['inviteCode'], $entity->getInviteCode());
        self::assertEquals($data['validUntil'], $entity->getValidUntil()->format(\DateTimeInterface::ATOM));
    }

    public function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'username' => 'oelie-boelie',
                    'email' => 'oelie@boelie.nl',
                    'inviteCode' => 'knjsdgnjkdgskjgsdfjkbnlsgdfkjnbgsdf',
                    'validUntil' => '2020-02-26T00:00:00+00:00',
                    'role' => 'EMPLOYEE',
                ],
            ],
        ];
    }
}
