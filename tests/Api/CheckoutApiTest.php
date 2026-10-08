<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use T3G\DatahubApiLibrary\Api\CheckoutApi;
use T3G\DatahubApiLibrary\Dto\CheckoutItemDto;
use T3G\DatahubApiLibrary\Dto\CheckoutPayloadDto;
use T3G\DatahubApiLibrary\Request\RequestContext;

class CheckoutApiTest extends AbstractApiTestCase
{
    /**
     * @var list<array{request: RequestInterface}>
     */
    private array $history = [];

    public function testCreateCheckoutSessionSendsPayload(): void
    {
        $response = $this->createApi(['customerSessionClientSecret' => 'cuss_secret', 'legalBody' => 't3company', 'mode' => 'payment', 'currency' => 'eur', 'amount' => 100, 'products' => []])
            ->createCheckoutSession(RequestContext::fromCombinedIdentifier('organization:4c3b2a10-0000-0000-0000-000000000000'), 'elts', new CheckoutPayloadDto([new CheckoutItemDto('price_1', 2, ['version' => '9.5'])]));

        self::assertSame('t3company', $response['legalBody']);
        $request = $this->history[0]['request'];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('/api/checkout/elts/checkout-session', $request->getUri()->getPath());
        self::assertStringContainsString('context%5Btype%5D=organization', $request->getUri()->getQuery());
        self::assertSame(
            ['items' => [['priceId' => 'price_1', 'quantity' => 2, 'metadata' => ['version' => '9.5']]], 'addressUuid' => null, 'referenceNumber' => null, 'payByInvoice' => false],
            json_decode((string) $request->getBody(), true, 512, JSON_THROW_ON_ERROR)
        );
    }

    public function testCreateCheckoutSessionSupportsLegacyItems(): void
    {
        $this->createApi([])->createCheckoutSession(RequestContext::fromCombinedIdentifier('user:max.muster'), 'certification', [['priceId' => 'price_1', 'quantity' => 1]]);

        self::assertSame(['items' => [['priceId' => 'price_1', 'quantity' => 1]]], json_decode((string) $this->history[0]['request']->getBody(), true, 512, JSON_THROW_ON_ERROR));
    }

    public function testGetPricingInformationSendsPayload(): void
    {
        $this->createApi([])->getPricingInformation(RequestContext::fromCombinedIdentifier('user:max.muster'), 'membership', new CheckoutPayloadDto([new CheckoutItemDto('price_1')], 'address-uuid'));

        $request = $this->history[0]['request'];
        self::assertSame('/api/checkout/membership/pricing-information', $request->getUri()->getPath());
        self::assertSame('address-uuid', json_decode((string) $request->getBody(), true, 512, JSON_THROW_ON_ERROR)['addressUuid']);
    }

    public function testGetPricingInformationSupportsLegacyArguments(): void
    {
        $this->createApi([])->getPricingInformation(RequestContext::fromCombinedIdentifier('user:max.muster'), 'membership', 'address-uuid', [['priceId' => 'price_1', 'quantity' => 1]]);

        self::assertSame(['items' => [['priceId' => 'price_1', 'quantity' => 1]], 'addressUuid' => 'address-uuid'], json_decode((string) $this->history[0]['request']->getBody(), true, 512, JSON_THROW_ON_ERROR));
    }

    public function testFinalizeOrderReturnsIntent(): void
    {
        $response = $this->createApi(['orderNumber' => 'STR-1', 'intent' => ['type' => 'setup', 'clientSecret' => 'seti_secret'], 'hostedInvoiceUrl' => null, 'payment_intent_client_secret' => 'seti_secret', 'hosted_invoice_url' => null])
            ->finalizeOrder(RequestContext::fromCombinedIdentifier('organization:4c3b2a10-0000-0000-0000-000000000000'), 'suite', new CheckoutPayloadDto([new CheckoutItemDto('price_1')], 'address-uuid', 'PO-42', true));

        self::assertSame(['type' => 'setup', 'clientSecret' => 'seti_secret'], $response['intent']);
        $request = $this->history[0]['request'];
        self::assertSame('/api/checkout/suite/finalize-order', $request->getUri()->getPath());
        $body = json_decode((string) $request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        self::assertSame('PO-42', $body['referenceNumber']);
        self::assertTrue($body['payByInvoice']);
    }

    public function testGetBillingPortalSessionSendsReturnUrl(): void
    {
        $this->createApi(['url' => 'https://billing.stripe.com/session'])->getBillingPortalSession(RequestContext::fromCombinedIdentifier('user:max.muster'), 'membership', 'https://my.typo3.org/membership');

        self::assertSame(['return_url' => 'https://my.typo3.org/membership'], json_decode((string) $this->history[0]['request']->getBody(), true, 512, JSON_THROW_ON_ERROR));
    }

    /**
     * @param array<mixed> $responseBody
     */
    private function createApi(array $responseBody): CheckoutApi
    {
        $handlerStack = HandlerStack::create(new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], json_encode($responseBody, JSON_THROW_ON_ERROR)),
        ]));
        $handlerStack->push(Middleware::history($this->history));

        return new CheckoutApi($this->getClient($handlerStack));
    }
}
