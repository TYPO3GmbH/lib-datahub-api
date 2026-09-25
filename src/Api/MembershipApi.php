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
     * @param array{priceId: string, quantity: int, metadata?: array<string, mixed>}[] $items
     *
     * @return array{customerSessionClientSecret: string, currency: string, amount: int, products: array<mixed>}[]
     *
     * @deprecated Use CheckoutApi->createCheckoutSession() instead
     */
    public function setupPaymentIntent(RequestContext $requestContext, array $items): array
    {
        return (new CheckoutApi($this->client))->createCheckoutSession($requestContext, 'membership', $items);
    }

    /**
     * @param array{priceId: string, addressUuid: string, payByInvoice: bool} $payload
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
     * @param array{priceId: string, quantity: int, metadata?: array<string, mixed>}[] $items
     *
     * @return array{currency: string, items: array{display_name: string, recurring: array{interval_count: int, interval: string}, amount: int, net: int, gross: int, applied_tax_rates: int[], metadata: string}, taxes: array{display_name: string, rate: float, amount: int}[], total: array{net: int, gross: int}}
     *
     * @deprecated Use CheckoutApi->getPricingInformation() instead
     */
    public function getPricingInformation(RequestContext $requestContext, string $addressUuid, array $items): array
    {
        return (new CheckoutApi($this->client))->getPricingInformation($requestContext, 'membership', $addressUuid, $items);
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

    /**
     * @deprecated Use CheckoutApi->getBillingPortalSession() instead
     */
    public function getBillingPortalSession(RequestContext $requestContext, string $returnUrl): array
    {
        return (new CheckoutApi($this->client))->getBillingPortalSession($requestContext, 'membership', $returnUrl);
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
