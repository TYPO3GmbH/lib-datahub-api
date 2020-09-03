<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use DateTime;
use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Enum\CompanyType;
use T3G\DatahubApiLibrary\Factory\CompanyFactory;

class CompanyFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = CompanyFactory::fromArray($data);
        $this->assertEquals($data['uuid'], $entity->getUuid());
        $this->assertEquals($data['companyType'] ?? CompanyType::AGENCY, $entity->getCompanyType());
        $this->assertEquals($data['title'], $entity->getTitle());
        $this->assertEquals($data['email'], $entity->getEmail());
        $this->assertEquals($data['vatId'], $entity->getVatId());
        $this->assertEquals($data['city'] ?? null, $entity->getCity());
        $this->assertEquals($data['country']['iso'] ?? null, $entity->getCountry());
        $this->assertCount(1, $entity->getEmployees());
        $this->assertEquals(
            $data['employees'][0]['joinedAt'],
            $entity->getEmployee($data['employees'][0]['user']['username'])
                ->getJoinedAt()
                ->format(DateTime::ATOM)
        );
        $this->assertEquals(
            $data['employees'][0]['role'],
            $entity->getEmployee($data['employees'][0]['user']['username'])
                ->getRole()
        );
        $this->assertEquals($data['backlink'] ?? null, $entity->getBacklink());
        $this->assertEquals($data['mapLocations'] ?? [], $entity->getMapLocations());
        $this->assertEquals($data['profilePageText'] ?? null, $entity->getProfilePageText());
        $this->assertEquals($data['contactFormAddress'] ?? null, $entity->getContactFormAddress());
        $this->assertEquals($data['photo'] ?? null, $entity->getPhoto());
        $this->assertEquals($data['logo'] ?? null, $entity->getLogo());
    }

    public function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'companyType' => CompanyType::FREELANCER,
                    'title' => 'Lidl',
                    'email' => 'lidl-people@example.com',
                    'vatId' => 'DE 123 456 789',
                    'employees' => [[
                        'uuid' => '00000000-0000-0000-0000-000000000000',
                        'role' => 'OWNER',
                        'joinedAt' => '2020-02-26T00:00:00+00:00',
                        'leftAt' => null,
                        'user' => [
                            'username' => 'oelie-boelie',
                            'firstName' => 'Oelie',
                            'lastName' => 'Boelie',
                        ]]
                    ],
                    'city' => 'Moscow',
                    'country' => [
                        'iso' => 'RU',
                    ],
                    'backlink' => 'https://typ03.org',
                    'mapLocations' => ['00000000-0000-0000-0000-000000000000', '55555555-5555-5555-5555-555555555555'],
                    'profilePageText' => '<b><i>Hello world</i>',
                    'contactFormAddress' => 'contact@typ03.org',
                    'photo' => 'https://my.typo3.org/companies/00000000-0000-0000-0000-000000000000/photo.jpeg',
                    'logo' => 'https://my.typo3.org/companies/00000000-0000-0000-0000-000000000000/logo.png',
                ],
            ],
            'missing company type, expect AGENCY' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'title' => 'Lidl',
                    'email' => 'lidl-people@example.com',
                    'vatId' => 'DE 123 456 789',
                    'employees' => [[
                        'uuid' => '00000000-0000-0000-0000-000000000000',
                        'role' => 'OWNER',
                        'joinedAt' => '2020-02-26T00:00:00+00:00',
                        'leftAt' => null,
                        'user' => [
                            'username' => 'oelie-boelie',
                            'firstName' => 'Oelie',
                            'lastName' => 'Boelie',
                        ]]
                    ]
                ]
            ]
        ];
    }
}
