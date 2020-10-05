<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\NotificationFactory;
use T3G\DatahubApiLibrary\Notification\AbstractNotification;
use T3G\DatahubApiLibrary\Notification\IncompletePaymentNotification;
use T3G\DatahubApiLibrary\Notification\UnknownNotification;

class NotificationFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     * @param array $expectations
     */
    public function testFactory(array $data, array $expectations): void
    {
        $entity = NotificationFactory::fromArray($data);
        self::assertInstanceOf(AbstractNotification::class, $entity);
        self::assertInstanceOf($expectations['__class'], $entity);
        foreach ($expectations as $key => $value) {
            if ('__class' !== $key) {
                self::assertSame($value, $entity->{$key}());
            }
        }
    }

    public function factoryDataProvider(): array
    {
        return [
            IncompletePaymentNotification::class => [
                'data' => [
                    'company' => '00000000-0000-0000-0000-000000000000',
                    'companyTitle' => 'Foo Company',
                    'subscription' => 'stripe:foo:bar',
                    'stripeLink' => 'https://pay.stripe.com/foo',
                    'type' => IncompletePaymentNotification::class,
                    'message' => 'Incomplete payment for company 00000000-0000-0000-0000-000000000000'
                ],
                'expectations' => [
                    '__class' => IncompletePaymentNotification::class,
                    'getCompany' => '00000000-0000-0000-0000-000000000000',
                    'getCompanyTitle' => 'Foo Company',
                    'getSubscription' => 'stripe:foo:bar',
                    'getStripeLink' => 'https://pay.stripe.com/foo',
                    'getMessage' => 'Incomplete payment for company 00000000-0000-0000-0000-000000000000'
                ]
            ],
            'unknown type' => [
                'data' => [
                    'type' => 'AnyInvalidNotificationType',
                ],
                'expectations' => ['__class' => UnknownNotification::class]
            ],
        ];
    }
}
