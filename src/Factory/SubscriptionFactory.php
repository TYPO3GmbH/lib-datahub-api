<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\Subscription;

/**
 * @extends AbstractFactory<Subscription>
 */
class SubscriptionFactory extends AbstractFactory
{
    public static function fromArray(array $data): Subscription
    {
        $subscription = (new Subscription())
            ->setUuid($data['uuid'])
            ->setSubscriptionIdentifier($data['subscriptionIdentifier'])
            ->setSubscriptionType($data['subscriptionType'])
            ->setSubscriptionSubType($data['subscriptionSubType'])
            ->setStripeLink($data['stripeLink'] ?? '')
            ->setValidUntil(new \DateTimeImmutable($data['validUntil']))
            ->setCancellationDeadline(new \DateTimeImmutable($data['cancellationDeadline']))
            ->setPayload($data['payload'] ?? null)
            ->setHistory($data['history'] ?? null)
            ->setSubscriptionStatus($data['subscriptionStatus'])
            ->setStatus($data['status'] ?? []);

        if (isset($data['user'])) {
            $subscription->setUser(UserFactory::fromArray($data['user']));
        }

        if (isset($data['company'])) {
            $subscription->setCompany(CompanyFactory::fromArray($data['company']));
        }

        return $subscription;
    }
}
