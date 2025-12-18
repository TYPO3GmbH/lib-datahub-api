<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use T3G\DatahubApiLibrary\Dto\SwitchMembershipDto;
use T3G\DatahubApiLibrary\Request\RequestContext;
use T3G\DatahubApiLibrary\Utility\JsonUtility;

class MembershipApi extends AbstractApi
{
    /**
     * @param array{price_id: string, quantity: int, metadata?: array<string, mixed>}[] $items
     */
    public function setupPaymentIntent(RequestContext $requestContext, array $items): array
    {
        $response = $this->client->request(
            'POST',
            self::uri('/membership/setup-payment-intent')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
            json_encode([
                'items' => $items,
            ], JSON_THROW_ON_ERROR)
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    /**
     * @param array{items: array{price_id: string, quantity: int, metadata?: array<string, mixed>}[], address_uuid: string} $payload
     */
    public function createMembership(RequestContext $requestContext, array $payload): array
    {
        $response = $this->client->request(
            'POST',
            self::uri('/membership/create-membership')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
            json_encode($payload, JSON_THROW_ON_ERROR)
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    public function getEligibleMemberships(RequestContext $requestContext): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/membership/all')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986))
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    /**
     * @param array{price_id: string, quantity: int, metadata?: array<string, mixed>}[] $items
     */
    public function getPricingInformation(RequestContext $requestContext, string $addressUuid, array $items): array
    {
        $payload = [
            'items' => $items,
            'addressUuid' => $addressUuid,
        ];
        $response = $this->client->request(
            'POST',
            self::uri('/membership/pricing-information')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
            json_encode($payload, JSON_THROW_ON_ERROR)
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    public function getSwitchInformation(RequestContext $requestContext, SwitchMembershipDto $upgradeMembershipDto): array
    {
        $dtoPayload = $upgradeMembershipDto->toArray();
        $signature = $this->createSignature(array_merge($requestContext->toArray(), $dtoPayload));
        $response = $this->client->request(
            'POST',
            self::uri('/membership/get-switch-information')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
            json_encode(array_merge($dtoPayload, [
                'signature' => $signature,
            ]), JSON_THROW_ON_ERROR)
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    public function switch(RequestContext $requestContext, SwitchMembershipDto $upgradeMembershipDto): array
    {
        $dtoPayload = $upgradeMembershipDto->toArray();
        $signature = $this->createSignature(array_merge($requestContext->toArray(), $dtoPayload));
        $response = $this->client->request(
            'POST',
            self::uri('/membership/switch')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
            json_encode(array_merge($dtoPayload, [
                'signature' => $signature,
            ]), JSON_THROW_ON_ERROR)
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    public function getUpgrades(RequestContext $requestContext): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/membership/upgrades')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986))
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    public function getDowngrades(RequestContext $requestContext): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/membership/downgrades')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986))
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    public function getBillingPortalSession(RequestContext $requestContext, string $returnUrl): array
    {
        $response = $this->client->request(
            'POST',
            self::uri('/membership/billing-portal-session')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
            json_encode([
                'return_url' => $returnUrl,
            ], JSON_THROW_ON_ERROR)
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    public function getProductForMembership(RequestContext $requestContext, string $subscriptionUuid): array
    {
        $queryParams = array_merge($requestContext->toArray(), [
            'subscriptionUuid' => $subscriptionUuid,
        ]);
        $response = $this->client->request(
            'GET',
            self::uri('/membership/membership-product')->withQuery(http_build_query($queryParams, encoding_type: PHP_QUERY_RFC3986))
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    private function createSignature(array $payload): string
    {
        $payloadHash = hash('sha256', json_encode($payload, JSON_THROW_ON_ERROR));
        $timestamp = (new \DateTimeImmutable('now', new \DateTimeZone('Etc/UTC')))->getTimestamp();

        return sprintf('%s|%d', $payloadHash, $timestamp);
    }
}
