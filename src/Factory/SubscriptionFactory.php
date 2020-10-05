<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\Subscription;

class SubscriptionFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): Subscription
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    public static function fromArray(array $data): Subscription
    {
        return (new Subscription())
            ->setUuid($data['uuid'])
            ->setSubscriptionIdentifier($data['subscriptionIdentifier'])
            ->setSubscriptionType($data['subscriptionType'])
            ->setSubscriptionSubType($data['subscriptionSubType'])
            ->setStripeLink($data['stripeLink'] ?? '')
            ->setValidUntil(new \DateTimeImmutable($data['validUntil']))
            ->setPayload($data['payload'] ?? null)
            ->setSubscriptionStatus($data['subscriptionStatus']);
    }
}
