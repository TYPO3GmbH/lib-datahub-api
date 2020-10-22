<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Enum\MembershipType;
use T3G\DatahubApiLibrary\Enum\SubscriptionStatus;
use T3G\DatahubApiLibrary\Enum\SubscriptionType;
use T3G\DatahubApiLibrary\Factory\SubscriptionFactory;

class SubscriptionFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = SubscriptionFactory::fromArray($data);
        self::assertEquals($data['uuid'], $entity->getUuid());
        self::assertEquals($data['subscriptionIdentifier'], $entity->getSubscriptionIdentifier());
        self::assertEquals($data['subscriptionType'], $entity->getSubscriptionType());
        self::assertEquals($data['subscriptionSubType'], $entity->getSubscriptionSubType());
        self::assertEquals($data['subscriptionStatus'], $entity->getSubscriptionStatus());
        self::assertEquals($data['validUntil'], $entity->getValidUntil()->format(\DateTime::ATOM));
        self::assertEquals($data['payload'] ?? null, $entity->getPayload());
        self::assertEquals($data['history'] ?? null, $entity->getHistory());

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
                    'subscriptionIdentifier' => 'sub_aaaaa',
                    'subscriptionType' => SubscriptionType::MEMBERSHIP,
                    'subscriptionSubType' => MembershipType::BRONZE,
                    'subscriptionStatus' => SubscriptionStatus::ACTIVE,
                    'validUntil' => '2020-02-26T00:00:00+00:00',
                    'history' => 'husel pusel',
                    'payload' => ['baz' => 'benzer'],
                    'user' => [
                        'username' => 'oelie-boelie',
                        'firstName' => 'Oelie',
                        'lastName' => 'Boelie',
                    ]
                ]
            ],
            'withCompany' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'subscriptionIdentifier' => 'sub_aaaaa',
                    'subscriptionType' => SubscriptionType::MEMBERSHIP,
                    'subscriptionSubType' => MembershipType::BRONZE,
                    'subscriptionStatus' => SubscriptionStatus::ACTIVE,
                    'validUntil' => '2020-02-26T00:00:00+00:00',
                    'history' => 'husel pusel',
                    'payload' => ['baz' => 'benzer'],
                    'company' => [
                        'uuid' => '00000000-0000-0000-0000-000000000000',
                        'companyType' => 'AGENCY',
                        'title' => 'Aldi',
                        'email' => 'aldi-nice-things@example.com',
                        'vatId' => 'DE 123 456 789',
                    ]
                ]
            ],
        ];
    }
}
