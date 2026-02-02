<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Entity;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\BitMask\AddressType;
use T3G\DatahubApiLibrary\BitMask\EmailType;
use T3G\DatahubApiLibrary\Entity\Address;
use T3G\DatahubApiLibrary\Entity\Company;
use T3G\DatahubApiLibrary\Enum\MembershipType;
use T3G\DatahubApiLibrary\Factory\CompanyFactory;

class CompanyTest extends TestCase
{
    #[DataProvider('emailDataProvider')]
    public function testEmails(Company $company, int $type, bool $onlyOptIn, ?string $expected): void
    {
        self::assertEquals($expected, $company->getEmailByType($type, $onlyOptIn));
    }

    public static function emailDataProvider(): array
    {
        return [
            'primary email confirmed' => [
                CompanyFactory::fromArray([
                    'title' => 'Company',
                    'uuid' => '12345678-1234-1234-1234-123456789012',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::PRIMARY,
                            'optIn' => '2020-01-01 00:00:00',
                        ],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::BRONZE,
                    ],
                ]),
                EmailType::PRIMARY,
                true,
                'foo@bar.com',
            ],
            'primary email unconfirmed' => [
                CompanyFactory::fromArray([
                    'title' => 'Company',
                    'uuid' => '12345678-1234-1234-1234-123456789012',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::PRIMARY,
                        ],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::BRONZE,
                    ],
                ]),
                EmailType::PRIMARY,
                true,
                null,
            ],
            'billing email confirmed' => [
                CompanyFactory::fromArray([
                    'title' => 'Company',
                    'uuid' => '12345678-1234-1234-1234-123456789012',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::BILLING,
                            'optIn' => '2020-01-01 00:00:00',
                        ],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::BRONZE,
                    ],
                ]),
                EmailType::BILLING,
                true,
                'foo@bar.com',
            ],
            'billing email unconfirmed' => [
                CompanyFactory::fromArray([
                    'title' => 'Company',
                    'uuid' => '12345678-1234-1234-1234-123456789012',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::BILLING,
                        ],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::BRONZE,
                    ],
                ]),
                EmailType::BILLING,
                true,
                null,
            ],
            'voting email confirmed' => [
                CompanyFactory::fromArray([
                    'title' => 'Company',
                    'uuid' => '12345678-1234-1234-1234-123456789012',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::VOTING,
                            'optIn' => '2020-01-01 00:00:00',
                        ],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::BRONZE,
                    ],
                ]),
                EmailType::VOTING,
                true,
                'foo@bar.com',
            ],
            'voting email unconfirmed' => [
                CompanyFactory::fromArray([
                    'title' => 'Company',
                    'uuid' => '12345678-1234-1234-1234-123456789012',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::VOTING,
                        ],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::BRONZE,
                    ],
                ]),
                EmailType::VOTING,
                true,
                null,
            ],
            'primary email confirmed but ignore optIn' => [
                CompanyFactory::fromArray([
                    'title' => 'Company',
                    'uuid' => '12345678-1234-1234-1234-123456789012',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::PRIMARY,
                            'optIn' => '2020-01-01 00:00:00',
                        ],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::BRONZE,
                    ],
                ]),
                EmailType::PRIMARY,
                false,
                'foo@bar.com',
            ],
            'primary email unconfirmed but ignore optIn' => [
                CompanyFactory::fromArray([
                    'title' => 'Company',
                    'uuid' => '12345678-1234-1234-1234-123456789012',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::PRIMARY,
                        ],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::BRONZE,
                    ],
                ]),
                EmailType::PRIMARY,
                false,
                'foo@bar.com',
            ],
            'billing email confirmed but ignore optIn' => [
                CompanyFactory::fromArray([
                    'title' => 'Company',
                    'uuid' => '12345678-1234-1234-1234-123456789012',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::BILLING,
                            'optIn' => '2020-01-01 00:00:00',
                        ],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::BRONZE,
                    ],
                ]),
                EmailType::BILLING,
                false,
                'foo@bar.com',
            ],
            'billing email unconfirmed but ignore optIn' => [
                CompanyFactory::fromArray([
                    'title' => 'Company',
                    'uuid' => '12345678-1234-1234-1234-123456789012',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::BILLING,
                        ],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::BRONZE,
                    ],
                ]),
                EmailType::BILLING,
                false,
                'foo@bar.com',
            ],
            'voting email confirmed but ignore optIn' => [
                CompanyFactory::fromArray([
                    'title' => 'Company',
                    'uuid' => '12345678-1234-1234-1234-123456789012',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::VOTING,
                            'optIn' => '2020-01-01 00:00:00',
                        ],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::BRONZE,
                    ],
                ]),
                EmailType::VOTING,
                false,
                'foo@bar.com',
            ],
            'voting email unconfirmed but ignore optIn' => [
                CompanyFactory::fromArray([
                    'title' => 'Company',
                    'uuid' => '12345678-1234-1234-1234-123456789012',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::VOTING,
                        ],
                    ],
                    'status' => [
                        'isFoundingPartner' => false,
                        'membership' => MembershipType::BRONZE,
                    ],
                ]),
                EmailType::VOTING,
                false,
                'foo@bar.com',
            ],
        ];
    }

    public function testGetAddressesByType(): void
    {
        $address1 = (new Address())->setType(AddressType::TYPE_DELIVERY);
        $address2 = (new Address())->setType(AddressType::TYPE_DELIVERY | AddressType::TYPE_INVOICE);
        $address3 = (new Address())->setType(AddressType::TYPE_INVOICE | AddressType::TYPE_LOCATION);
        $input = [$address1, $address2, $address3];
        $company = (new Company())->setAddresses($input);

        $expectation = [$address2, $address3];
        $result = $company->getAddressesByType(AddressType::TYPE_INVOICE);

        self::assertEquals($expectation, $result);
        self::assertTrue(array_is_list($result));
    }
}
