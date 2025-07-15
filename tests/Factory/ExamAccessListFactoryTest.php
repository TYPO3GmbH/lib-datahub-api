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
use T3G\DatahubApiLibrary\Entity\ExamAccess;
use T3G\DatahubApiLibrary\Enum\CertificationType;
use T3G\DatahubApiLibrary\Enum\CertificationVersion;
use T3G\DatahubApiLibrary\Enum\CompanyType;
use T3G\DatahubApiLibrary\Enum\ExamAccessStatus;
use T3G\DatahubApiLibrary\Enum\MembershipType;
use T3G\DatahubApiLibrary\Enum\PartnerProgramType;
use T3G\DatahubApiLibrary\Factory\ExamAccessListFactory;

class ExamAccessListFactoryTest extends TestCase
{
    #[DataProvider('factoryDataProvider')]
    public function testFactory(array $data): void
    {
        $list = ExamAccessListFactory::fromArray($data);
        foreach ($list as $entity) {
            self::assertInstanceOf(ExamAccess::class, $entity);
        }
    }

    public static function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'entities' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'voucher' => '00000000-0000-0000-0000-000000000000',
                            'user' => [
                                'username' => 'max.muster',
                                'firstName' => 'Max',
                                'lastName' => 'Muster',
                                'status' => [
                                    'membership' => MembershipType::SILVER,
                                    'certifications' => [CertificationType::TCCI],
                                ],
                            ],
                            'company' => null,
                            'certificationType' => CertificationType::TCCC,
                            'certificationVersion' => CertificationVersion::TEN,
                            'status' => ExamAccessStatus::READY,
                            'history' => null,
                            'createdAt' => (new \DateTime('now'))->format(\DateTimeInterface::ATOM),
                            'validUntil' => (new \DateTime('+3 months'))->format(\DateTimeInterface::ATOM),

                        ],
                        [
                            'uuid' => '11111111-1111-1111-1111-111111111111',
                            'voucher' => '11111111-1111-1111-1111-111111111111',
                            'user' => null,
                            'company' => [
                                'uuid' => '00000000-0000-0000-0000-000000000000',
                                'companyType' => CompanyType::AGENCY,
                                'title' => 'Company A',
                                'slug' => 'company-a',
                                'status' => [
                                    'isFoundingPartner' => false,
                                    'membership' => MembershipType::GOLD,
                                    'partnerType' => PartnerProgramType::NONE,
                                ],
                            ],
                            'certificationType' => CertificationType::TCCD,
                            'certificationVersion' => CertificationVersion::NINE,
                            'status' => ExamAccessStatus::USED,
                            'history' => null,
                            'createdAt' => (new \DateTime('now'))->format(\DateTimeInterface::ATOM),
                            'validUntil' => (new \DateTime('+3 months'))->format(\DateTimeInterface::ATOM),
                        ],
                    ],
                    'length' => 2,
                    'type' => 'App\\Entity\\ExamAccessList',
                ],
            ],
        ];
    }
}
