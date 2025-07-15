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
use T3G\DatahubApiLibrary\BitMask\EmailType;
use T3G\DatahubApiLibrary\Entity\User;
use T3G\DatahubApiLibrary\Enum\MembershipType;
use T3G\DatahubApiLibrary\Factory\UserFactory;

class UserTest extends TestCase
{
    #[DataProvider('emailDataProvider')]
    public function testEmails(User $user, int $type, bool $onlyOptIn, ?string $expected): void
    {
        self::assertEquals($expected, $user->getEmailByType($type, $onlyOptIn));
    }

    public static function emailDataProvider(): array
    {
        return [
            'primary email confirmed' => [
                UserFactory::fromArray([
                    'username' => 'foo',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::PRIMARY,
                            'optIn' => '2020-01-01 00:00:00',
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::BRONZE,
                        'certifications' => [],
                    ],
                ]),
                EmailType::PRIMARY,
                true,
                'foo@bar.com',
            ],
            'primary email unconfirmed' => [
                UserFactory::fromArray([
                    'username' => 'foo',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::PRIMARY,
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::BRONZE,
                        'certifications' => [],
                    ],
                ]),
                EmailType::PRIMARY,
                true,
                null,
            ],
            'billing email confirmed' => [
                UserFactory::fromArray([
                    'username' => 'foo',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::BILLING,
                            'optIn' => '2020-01-01 00:00:00',
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::BRONZE,
                        'certifications' => [],
                    ],
                ]),
                EmailType::BILLING,
                true,
                'foo@bar.com',
            ],
            'billing email unconfirmed' => [
                UserFactory::fromArray([
                    'username' => 'foo',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::BILLING,
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::BRONZE,
                        'certifications' => [],
                    ],
                ]),
                EmailType::BILLING,
                true,
                null,
            ],
            'voting email confirmed' => [
                UserFactory::fromArray([
                    'username' => 'foo',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::VOTING,
                            'optIn' => '2020-01-01 00:00:00',
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::BRONZE,
                        'certifications' => [],
                    ],
                ]),
                EmailType::VOTING,
                true,
                'foo@bar.com',
            ],
            'voting email unconfirmed' => [
                UserFactory::fromArray([
                    'username' => 'foo',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::VOTING,
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::BRONZE,
                        'certifications' => [],
                    ],
                ]),
                EmailType::VOTING,
                true,
                null,
            ],
            'primary email confirmed but ignore optIn' => [
                UserFactory::fromArray([
                    'username' => 'foo',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::PRIMARY,
                            'optIn' => '2020-01-01 00:00:00',
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::BRONZE,
                        'certifications' => [],
                    ],
                ]),
                EmailType::PRIMARY,
                false,
                'foo@bar.com',
            ],
            'primary email unconfirmed but ignore optIn' => [
                UserFactory::fromArray([
                    'username' => 'foo',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::PRIMARY,
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::BRONZE,
                        'certifications' => [],
                    ],
                ]),
                EmailType::PRIMARY,
                false,
                'foo@bar.com',
            ],
            'billing email confirmed but ignore optIn' => [
                UserFactory::fromArray([
                    'username' => 'foo',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::BILLING,
                            'optIn' => '2020-01-01 00:00:00',
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::BRONZE,
                        'certifications' => [],
                    ],
                ]),
                EmailType::BILLING,
                false,
                'foo@bar.com',
            ],
            'billing email unconfirmed but ignore optIn' => [
                UserFactory::fromArray([
                    'username' => 'foo',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::BILLING,
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::BRONZE,
                        'certifications' => [],
                    ],
                ]),
                EmailType::BILLING,
                false,
                'foo@bar.com',
            ],
            'voting email confirmed but ignore optIn' => [
                UserFactory::fromArray([
                    'username' => 'foo',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::VOTING,
                            'optIn' => '2020-01-01 00:00:00',
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::BRONZE,
                        'certifications' => [],
                    ],
                ]),
                EmailType::VOTING,
                false,
                'foo@bar.com',
            ],
            'voting email unconfirmed but ignore optIn' => [
                UserFactory::fromArray([
                    'username' => 'foo',
                    'emailAddresses' => [
                        [
                            'uuid' => '12345678-1234-1234-1234-123456789012',
                            'email' => 'foo@bar.com',
                            'type' => EmailType::VOTING,
                        ],
                    ],
                    'status' => [
                        'membership' => MembershipType::BRONZE,
                        'certifications' => [],
                    ],
                ]),
                EmailType::VOTING,
                false,
                'foo@bar.com',
            ],
        ];
    }
}
