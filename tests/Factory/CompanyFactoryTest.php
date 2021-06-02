<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\BitMask\EmailType;
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
        $this->assertCount(1, $entity->getEmailAddresses());
        $this->assertEquals(
            $data['emailAddresses'][0]['email'],
            $entity->getEmailAddresses()[0]->getEmail()
        );
        $this->assertEquals(
            $data['emailAddresses'][0]['type'],
            $entity->getEmailAddresses()[0]->getType()
        );
        $this->assertEquals(
            $data['employees'][0]['role'],
            $entity->getEmployee($data['employees'][0]['user']['username'])
                ->getRole()
        );
        $this->assertCount(1, $entity->getEmployees());
        $this->assertEquals(
            $data['employees'][0]['joinedAt'],
            $entity->getEmployee($data['employees'][0]['user']['username'])
                ->getJoinedAt()
                ->format(\DateTimeInterface::ATOM)
        );
        $this->assertEquals(
            $data['employees'][0]['role'],
            $entity->getEmployee($data['employees'][0]['user']['username'])
                ->getRole()
        );
        $this->assertEquals($data['backlink'] ?? null, $entity->getBacklink());
        $this->assertCount(count($data['mapLocations'] ?? []), $entity->getMapLocations());
        $this->assertEquals($data['teaserText'] ?? null, $entity->getTeaserText());
        $this->assertEquals($data['profilePageText'] ?? null, $entity->getProfilePageText());
        $this->assertEquals($data['contactFormAddress'] ?? null, $entity->getContactFormAddress());
        $this->assertEquals($data['photo'] ?? null, $entity->getPhoto());
        $this->assertEquals($data['logo'] ?? null, $entity->getLogo());
        if (isset($data['headquarter'])) {
            $this->assertEquals($data['headquarter']['uuid'], $entity->getHeadquarter()->getUuid());
        }
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
                    'emailAddresses' => [[
                        'uuid' => '652a0b52-7f69-4f81-882f-343592ae26aa',
                        'email' => 'oelie@boelie.nl',
                        'type' => EmailType::PRIMARY,
                    ]],
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
                    'headquarter' => [
                        'uuid' => '00000000-0000-0000-0000-000000000000',
                        'title' => 'test address',
                        'firstName' => 'Max',
                        'lastName' => 'Mustermann',
                        'additionalAddressLine1' => 'Musterabteilung',
                        'additionalAddressLine2' => 'Sondermuster',
                        'street' => 'Teststreet 1234',
                        'city' => 'Dorf und so',
                        'country' => [
                            'iso' => 'RU',
                            'iso3' => 'RUS',
                            'label' => 'Russia'
                        ],
                        'zip' => '1234 QZ',
                        'type' => 16,
                        'latitude' => 12.94856534257,
                        'longitude' => 8.765486753485,
                        'checksum' => 'fd4208f5e890fa65bf45e47c6b14ae5c3f16cd086dd9984c06b197970f45874c',
                    ],
                    'city' => 'Moscow',
                    'country' => [
                        'iso' => 'RU',
                    ],
                    'backlink' => 'https://typ03.org',
                    'mapLocations' => [[
                        'uuid' => '00000000-0000-0000-0000-000000000000',
                        'title' => 'test address',
                        'firstName' => 'Max',
                        'lastName' => 'Mustermann',
                        'additionalAddressLine1' => 'Musterabteilung',
                        'additionalAddressLine2' => 'Sondermuster',
                        'street' => 'Teststreet 1234',
                        'city' => 'Dorf und so',
                        'country' => [
                            'iso' => 'RU',
                            'iso3' => 'RUS',
                            'label' => 'Russia'
                        ],
                        'zip' => '1234 QZ',
                        'type' => 16,
                        'latitude' => 12.94856534257,
                        'longitude' => 8.765486753485,
                        'checksum' => 'fd4208f5e890fa65bf45e47c6b14ae5c3f16cd086dd9984c06b197970f45874c',
                    ]],
                    'teaserText' => '<b><i>I\'m Honest Joe and welcome to Jackass.</i>',
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
                    'emailAddresses' => [[
                        'uuid' => 'e3ad302d-9e14-4259-8108-a625b408d787',
                        'email' => 'oelie@boelie.nl',
                        'type' => EmailType::PRIMARY,
                    ]],
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
