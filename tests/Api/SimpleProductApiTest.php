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
use GuzzleHttp\Psr7\Request;
use T3G\DatahubApiLibrary\Api\SimpleProductApi;
use T3G\DatahubApiLibrary\Enum\LegalBody;
use T3G\DatahubApiLibrary\Request\RequestContext;

class SimpleProductApiTest extends AbstractApiTestCase
{
    public function testGetProductsForCheckout(): void
    {
        $container = [];
        $simpleProductApi = new SimpleProductApi($this->getClient($this->getHandlerStack('GetSimpleProductsForCheckoutResponse.php', $container)));
        $products = $simpleProductApi->getProductsForCheckout(new RequestContext('user', 'oelie.boelie'));

        self::assertSame('prod_King', $products['prod_King']['product']['id']);
        self::assertSame(900, $products['prod_King']['discountedPrices']['price_King']);
        self::assertSame('acct_testaccount', $products['prod_King']['account']);
        self::assertRequest(
            $container,
            'GET',
            'https://datahub.typo3.com/api/simple-products/checkout?context%5Btype%5D=user&context%5Bidentifier%5D=oelie.boelie'
        );
    }

    public function testGetProductForCheckout(): void
    {
        $container = [];
        $simpleProductApi = new SimpleProductApi($this->getClient($this->getHandlerStack('GetSimpleProductForCheckoutResponse.php', $container)));
        $product = $simpleProductApi->getProductForCheckout(
            new RequestContext('user', 'oelie.boelie'),
            LegalBody::TYPO3_COMPANY,
            'king-of-the-association'
        );

        self::assertSame('prod_King', $product['product']['id']);
        self::assertSame('acct_testaccount', $product['account']);
        self::assertRequest(
            $container,
            'GET',
            'https://datahub.typo3.com/api/simple-products/checkout/t3company/king-of-the-association?context%5Btype%5D=user&context%5Bidentifier%5D=oelie.boelie'
        );
    }

    private function getHandlerStack(string $fixture, array &$container): HandlerStack
    {
        $handlerStack = HandlerStack::create(new MockHandler([
            require __DIR__ . '/../Fixtures/SimpleProductApi/' . $fixture,
        ]));
        $handlerStack->push(Middleware::history($container));

        return $handlerStack;
    }

    private static function assertRequest(array $container, string $method, string $uri): Request
    {
        self::assertCount(1, $container);

        /** @var Request $request */
        $request = reset($container)['request'];
        self::assertSame($method, $request->getMethod());
        self::assertSame($uri, (string) $request->getUri());

        return $request;
    }
}
