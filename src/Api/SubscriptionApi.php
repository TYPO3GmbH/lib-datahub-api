<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use T3G\DatahubApiLibrary\Demand\SubscriptionFilterQuery;
use T3G\DatahubApiLibrary\Entity\Subscription;
use T3G\DatahubApiLibrary\Factory\SubscriptionFactory;
use T3G\DatahubApiLibrary\Factory\SubscriptionListFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class SubscriptionApi extends AbstractApi
{
    use HandlesUuids;

    public function getSubscription(string $uuid): Subscription
    {
        $this->isValidUuidOrThrow($uuid);

        return SubscriptionFactory::fromResponse(
            $this->client->request(
                'GET',
                '/subscription/' . $uuid
            )
        );
    }

    /** @phpstan-return array<int,mixed> */
    public function getSubscriptionProducts(): array
    {
        $data = $this->client->request(
            'GET',
            '/subscription/products'
        )->getBody();
        return json_decode((string)$data, true, 512, JSON_THROW_ON_ERROR);
    }

    public function getSubscriptionBySubscriptionIdentifier(string $subscriptionIdentifier): Subscription
    {
        return SubscriptionFactory::fromResponse(
            $this->client->request(
                'GET',
                '/subscription/identifier/' . $subscriptionIdentifier
            )
        );
    }

    /**
     * @param SubscriptionFilterQuery $subscriptionFilterQuery
     * @return array<int, Subscription>
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \T3G\DatahubApiLibrary\Exception\DatahubResponseException
     */
    public function getSubscriptionFiltered(SubscriptionFilterQuery $subscriptionFilterQuery): array
    {
        return SubscriptionListFactory::fromResponse(
            $this->client->request(
                'GET',
                '/subscription/filtered?' . $subscriptionFilterQuery->getQueryAsString()
            )
        );
    }

    public function createSubscriptionForUser(string $username, Subscription $subscription): Subscription
    {
        return SubscriptionFactory::fromResponse(
            $this->client->request(
                'POST',
                sprintf('/users/%s/subscriptions', rawurlencode(mb_strtolower($username))),
                json_encode($subscription, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    public function createSubscriptionForCompany(string $uuid, Subscription $subscription): Subscription
    {
        return SubscriptionFactory::fromResponse(
            $this->client->request(
                'POST',
                sprintf('/companies/%s/subscriptions', $uuid),
                json_encode($subscription, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    public function updateSubscription(string $uuid, Subscription $subscription): Subscription
    {
        $this->isValidUuidOrThrow($uuid);

        return SubscriptionFactory::fromResponse(
            $this->client->request(
                'PUT',
                '/subscription/' . $uuid,
                json_encode($subscription, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    public function deleteSubscription(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            '/subscription/' . $uuid
        );
    }
}
