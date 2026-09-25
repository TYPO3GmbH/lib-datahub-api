<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use T3G\DatahubApiLibrary\Request\RequestContext;
use T3G\DatahubApiLibrary\Utility\JsonUtility;

class CheckoutApi extends AbstractApi
{
    /**
     * @param array{priceId: string, quantity: int, metadata?: array<string, mixed>}[] $items
     *
     * @return array{customerSessionClientSecret: string, currency: string, amount: int, products: array<mixed>}[]
     */
    public function createCheckoutSession(RequestContext $requestContext, string $scope, array $items): array
    {
        $response = $this->client->request(
            'POST',
            self::uri('/checkout/' . $scope . '/checkout-session')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
            json_encode([
                'items' => $items,
            ], JSON_THROW_ON_ERROR)
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    /**
     * @param array{priceId: string, quantity: int, metadata?: array<string, mixed>}[] $items
     *
     * @return array{currency: string, items: array{display_name: string, recurring: array{interval_count: int, interval: string}, amount: int, net: int, gross: int, applied_tax_rates: int[], metadata: string}, taxes: array{display_name: string, rate: float, amount: int}[], total: array{net: int, gross: int}}
     */
    public function getPricingInformation(RequestContext $requestContext, string $scope, string $addressUuid, array $items): array
    {
        $payload = [
            'items' => $items,
            'addressUuid' => $addressUuid,
        ];
        $response = $this->client->request(
            'POST',
            self::uri('/checkout/' . $scope . '/pricing-information')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
            json_encode($payload, JSON_THROW_ON_ERROR)
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    /**
     * @param array{items: array{priceId: string, quantity: int, metadata?: array<string, mixed>}[], addressUuid: string, referenceNumber?: string} $payload
     *
     * @return array{payment_intent_client_secret: string}
     */
    public function finalizeOrder(RequestContext $requestContext, string $scope, array $payload): array
    {
        $response = $this->client->request(
            'POST',
            self::uri('/checkout/' . $scope . '/finalize-order')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
            json_encode($payload, JSON_THROW_ON_ERROR)
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    public function getBillingPortalSession(RequestContext $requestContext, string $scope, string $returnUrl): array
    {
        $response = $this->client->request(
            'POST',
            self::uri('/checkout/' . $scope . '/billing-portal-session')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
            json_encode([
                'return_url' => $returnUrl,
            ], JSON_THROW_ON_ERROR)
        );

        return JsonUtility::decode((string) $response->getBody());
    }
}
