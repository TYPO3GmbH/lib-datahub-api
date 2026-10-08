<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use T3G\DatahubApiLibrary\Dto\CheckoutPayloadDto;
use T3G\DatahubApiLibrary\Request\RequestContext;
use T3G\DatahubApiLibrary\Utility\JsonUtility;

/**
 * The generic checkout for every kind of goods sold via Stripe. The scope (see CheckoutScope) determines the seller and
 * which prices may be purchased, the prices determine whether goods are billed once or as a subscription.
 *
 * @phpstan-type CheckoutItem array{priceId: string, quantity: int, metadata?: array<string, mixed>}
 * @phpstan-type CheckoutSession array{customerSessionClientSecret: string, legalBody: string, mode: 'payment'|'subscription', currency: string, amount: int, products: array<mixed>}
 * @phpstan-type PricingInformation array{currency: string, items: list<array{display_name: string, recurring: array<string, mixed>, amount: int, net: int, gross: int, applied_tax_rates: array<int|float>, metadata?: array<string, mixed>}>, taxes: list<array{display_name: string, rate: float|int|string, amount: float|int}>, total: array{net: int, gross: int}}
 * @phpstan-type FinalizedOrder array{orderNumber: string|null, intent: array{type: 'payment'|'setup', clientSecret: string}|null, hostedInvoiceUrl: string|null, payment_intent_client_secret: string|null, hosted_invoice_url: string|null}
 */
class CheckoutApi extends AbstractApi
{
    /**
     * @param CheckoutPayloadDto|list<CheckoutItem> $payload passing the items only is deprecated
     *
     * @return CheckoutSession
     */
    public function createCheckoutSession(RequestContext $requestContext, string $scope, CheckoutPayloadDto|array $payload): array
    {
        /** @var CheckoutSession $response */
        $response = $this->post($requestContext, $scope, 'checkout-session', $payload instanceof CheckoutPayloadDto ? $payload : ['items' => $payload]);

        return $response;
    }

    /**
     * @param CheckoutPayloadDto|string|null $payload passing the address uuid and the items separately is deprecated
     * @param list<CheckoutItem>             $items
     *
     * @return PricingInformation
     */
    public function getPricingInformation(RequestContext $requestContext, string $scope, CheckoutPayloadDto|string|null $payload, array $items = []): array
    {
        /** @var PricingInformation $response */
        $response = $this->post($requestContext, $scope, 'pricing-information', $payload instanceof CheckoutPayloadDto ? $payload : [
            'items' => $items,
            'addressUuid' => $payload,
        ]);

        return $response;
    }

    /**
     * Places the order. Unless paying by invoice, the returned intent has to be confirmed with the payment element:
     * a "payment" intent with stripe.confirmPayment(), a "setup" intent with stripe.confirmSetup().
     *
     * @param CheckoutPayloadDto|array{items: list<CheckoutItem>, addressUuid: string, referenceNumber?: string|null, payByInvoice?: bool} $payload
     *
     * @return FinalizedOrder
     */
    public function finalizeOrder(RequestContext $requestContext, string $scope, CheckoutPayloadDto|array $payload): array
    {
        /** @var FinalizedOrder $response */
        $response = $this->post($requestContext, $scope, 'finalize-order', $payload);

        return $response;
    }

    /**
     * @return array<mixed>
     */
    public function getBillingPortalSession(RequestContext $requestContext, string $scope, string $returnUrl): array
    {
        return $this->post($requestContext, $scope, 'billing-portal-session', [
            'return_url' => $returnUrl,
        ]);
    }

    /**
     * @param CheckoutPayloadDto|array<string, mixed> $payload
     *
     * @return array<mixed>
     */
    private function post(RequestContext $requestContext, string $scope, string $action, CheckoutPayloadDto|array $payload): array
    {
        $response = $this->client->request(
            'POST',
            self::uri('/checkout/' . $scope . '/' . $action)->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
            json_encode($payload, JSON_THROW_ON_ERROR)
        );

        return JsonUtility::decode((string) $response->getBody());
    }
}
