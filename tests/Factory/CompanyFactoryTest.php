<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\BitMask\EmailType;
use T3G\DatahubApiLibrary\Enum\CertificationType;
use T3G\DatahubApiLibrary\Enum\CertificationVersion;
use T3G\DatahubApiLibrary\Enum\CompanyType;
use T3G\DatahubApiLibrary\Enum\ExamAccessStatus;
use T3G\DatahubApiLibrary\Enum\MembershipType;
use T3G\DatahubApiLibrary\Enum\PartnerProgramType;
use T3G\DatahubApiLibrary\Factory\CompanyFactory;

class CompanyFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     *
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = CompanyFactory::fromArray($data);
        self::assertEquals($data['uuid'], $entity->getUuid());
        self::assertEquals($data['companyType'] ?? CompanyType::AGENCY, $entity->getCompanyType());
        self::assertEquals($data['title'], $entity->getTitle());
        self::assertEquals($data['email'], $entity->getEmail());
        self::assertEquals($data['vatId'], $entity->getVatId());
        self::assertEquals($data['city'] ?? null, $entity->getCity());
        self::assertEquals($data['country']['iso'] ?? null, $entity->getCountry());
        self::assertCount(1, $entity->getEmailAddresses());
        self::assertEquals(
            $data['emailAddresses'][0]['email'],
            $entity->getEmailAddresses()[0]->getEmail()
        );
        self::assertEquals(
            $data['emailAddresses'][0]['type'],
            $entity->getEmailAddresses()[0]->getType()
        );
        self::assertEquals(
            $data['employees'][0]['role'],
            $entity->getEmployee($data['employees'][0]['user']['username'])
                ->getRole()
        );
        self::assertCount(1, $entity->getEmployees());
        self::assertEquals(
            $data['employees'][0]['joinedAt'],
            $entity->getEmployee($data['employees'][0]['user']['username'])
                ->getJoinedAt()
                ->format(\DateTimeInterface::ATOM)
        );
        self::assertEquals(
            $data['employees'][0]['role'],
            $entity->getEmployee($data['employees'][0]['user']['username'])
                ->getRole()
        );
        self::assertEquals($data['backlink'] ?? null, $entity->getBacklink());
        self::assertCount(count($data['mapLocations'] ?? []), $entity->getMapLocations());
        self::assertEquals($data['teaserText'] ?? null, $entity->getTeaserText());
        self::assertEquals($data['profilePageText'] ?? null, $entity->getProfilePageText());
        self::assertEquals($data['contactFormAddress'] ?? null, $entity->getContactFormAddress());
        self::assertEquals($data['photo'] ?? null, $entity->getPhoto());
        self::assertEquals($data['logo'] ?? null, $entity->getLogo());
        if (isset($data['headquarter'])) {
            self::assertEquals($data['headquarter']['uuid'], $entity->getHeadquarter()->getUuid());
        }
        if (isset($data['examAccesses'])) {
            foreach ($data['examAccesses'] as $examKey => $examAccess) {
                self::assertEquals($examAccess['uuid'], $entity->getExamAccesses()[$examKey]->getUuid());
                self::assertEquals($examAccess['voucher'], $entity->getExamAccesses()[$examKey]->getVoucher());
                self::assertEquals($examAccess['certificationType'], $entity->getExamAccesses()[$examKey]->getCertificationType());
                self::assertEquals($examAccess['certificationVersion'], $entity->getExamAccesses()[$examKey]->getCertificationVersion());
                self::assertEquals($examAccess['status'], $entity->getExamAccesses()[$examKey]->getStatus());
            }
        }
        self::assertSame($data['status'], $entity->getStatus());
    }

    public static function factoryDataProvider(): array
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
                            'status' => [
                                'membership' => MembershipType::COMMUNITY,
                                'certifications' => [CertificationType::TCCD],
                            ],
                        ]],
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
                            'label' => 'Russia',
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
                            'label' => 'Russia',
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
                    'examAccesses' => [
                        [
                            'uuid' => '22222222-2222-2222-2222-222222222222',
                            'voucher' => '22222222-2222-2222-2222-222222222222',
                            'certificationType' => CertificationType::TCCD,
                            'certificationVersion' => CertificationVersion::TEN,
                            'status' => ExamAccessStatus::READY,
                        ],
                        [
                            'uuid' => '33333333-3333-3333-3333-333333333333',
                            'voucher' => '33333333-3333-3333-3333-333333333333',
                            'certificationType' => CertificationType::TCCC,
                            'certificationVersion' => CertificationVersion::NINE,
                            'status' => ExamAccessStatus::READY,
                        ],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::PLATINUM,
                        'partnerType' => PartnerProgramType::NONE,
                    ],
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
                            'status' => [
                                'membership' => MembershipType::COMMUNITY,
                                'certifications' => [CertificationType::TCCD],
                            ],
                        ]],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::PLATINUM,
                        'partnerType' => PartnerProgramType::NONE,
                    ],
                ],
            ],
        ];
    }
}
