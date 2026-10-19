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
use T3G\DatahubApiLibrary\Api\ProductCatalogApi;
use T3G\DatahubApiLibrary\Enum\CheckoutScope;
use T3G\DatahubApiLibrary\Enum\LegalBody;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Request\RequestContext;

class ProductCatalogApiTest extends AbstractApiTestCase
{
    /**
     * @var list<array{request: RequestInterface}>
     */
    private array $history = [];

    public function testGetProductsRequestsTheScope(): void
    {
        $products = $this->createApi(200, ['products' => [['product' => ['id' => 'prod_1'], 'prices' => [], 'discountedPrices' => [], 'account' => 'acct_1', 'attributes' => ['comparison' => 'upgrade']]], 'meta' => ['currentMembershipSubscription' => null]])
            ->getProducts(RequestContext::fromCombinedIdentifier('organization:4c3b2a10-0000-0000-0000-000000000000'), CheckoutScope::MEMBERSHIP);

        self::assertSame('prod_1', $products['products'][0]['product']['id']);
        self::assertSame('upgrade', $products['products'][0]['attributes']['comparison']);
        $request = $this->history[0]['request'];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('/api/products/membership', $request->getUri()->getPath());
        self::assertStringContainsString('context%5Btype%5D=organization', $request->getUri()->getQuery());
        self::assertStringNotContainsString('legalBody', $request->getUri()->getQuery());
    }

    public function testGetProductsSendsLegalBody(): void
    {
        $this->createApi(200, ['products' => [], 'meta' => []])
            ->getProducts(RequestContext::fromCombinedIdentifier('user:max.muster'), CheckoutScope::SIMPLE_PRODUCT, LegalBody::TYPO3_ASSOCIATION);

        $request = $this->history[0]['request'];
        self::assertSame('/api/products/simple_product', $request->getUri()->getPath());
        self::assertStringContainsString('legalBody=' . LegalBody::TYPO3_ASSOCIATION, $request->getUri()->getQuery());
    }

    public function testGetProductRequestsTheIdentifier(): void
    {
        $product = $this->createApi(200, ['product' => ['id' => 'prod_King'], 'prices' => [], 'discountedPrices' => [], 'account' => 'acct_1', 'attributes' => []])
            ->getProduct(RequestContext::fromCombinedIdentifier('user:max.muster'), CheckoutScope::SIMPLE_PRODUCT, 'king of/the association', LegalBody::TYPO3_COMPANY);

        self::assertSame('prod_King', $product['product']['id']);
        $request = $this->history[0]['request'];
        self::assertSame('/api/products/simple_product/king%20of%2Fthe%20association', $request->getUri()->getPath());
        self::assertStringContainsString('legalBody=' . LegalBody::TYPO3_COMPANY, $request->getUri()->getQuery());
    }

    public function testUnknownProductThrowsException(): void
    {
        $this->expectException(DatahubResponseException::class);

        $this->createApi(404, ['title' => 'Not Found'])->getProduct(RequestContext::fromCombinedIdentifier('user:max.muster'), CheckoutScope::CERTIFICATION, 'prod_unknown');
    }

    /**
     * @param array<mixed> $responseBody
     */
    private function createApi(int $status, array $responseBody): ProductCatalogApi
    {
        $handlerStack = HandlerStack::create(new MockHandler([
            new Response($status, ['Content-Type' => 'application/json'], json_encode($responseBody, JSON_THROW_ON_ERROR)),
        ]));
        $handlerStack->push(Middleware::history($this->history));

        return new ProductCatalogApi($this->getClient($handlerStack));
    }
}
