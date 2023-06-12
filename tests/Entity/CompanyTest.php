<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Entity;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\BitMask\EmailType;
use T3G\DatahubApiLibrary\Entity\Company;
use T3G\DatahubApiLibrary\Factory\CompanyFactory;

class CompanyTest extends TestCase
{
    /**
     * @dataProvider emailDataProvider
     */
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
                ]),
                EmailType::VOTING,
                false,
                'foo@bar.com',
            ],
        ];
    }
}
