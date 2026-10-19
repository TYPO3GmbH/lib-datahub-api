<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Request\RequestContext;
use T3G\DatahubApiLibrary\Utility\JsonUtility;

/**
 * The purchasable products of every kind of goods (see CheckoutScope), composed for the entity of the request context.
 * Scope specific data is passed in `attributes` per product and in `meta` for the whole list, e.g.:
 *   - membership: attribute `comparison` ("upgrade", "downgrade", "unchanged", "undecided"), meta `currentMembershipSubscription`
 *   - elts: attributes `version`, `variants`, `maxRuntimeInYears`, `ltsSupport`, `eltsSupport`, `prolongablePlans`.
 *
 * @phpstan-type CatalogProduct array{product: array<string, mixed>, prices: list<array<string, mixed>>, discountedPrices: array<string, int>, account: string, attributes: array<string, mixed>}
 * @phpstan-type ProductList array{products: list<CatalogProduct>, meta: array<string, mixed>}
 */
class ProductCatalogApi extends AbstractApi
{
    /**
     * @param string|null $legalBody restricts simple products to those sold by this legal body (see LegalBody), not supported by other scopes
     *
     * @return ProductList
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     */
    public function getProducts(RequestContext $requestContext, string $scope, ?string $legalBody = null): array
    {
        /** @var ProductList $response */
        $response = $this->get($requestContext, '/products/' . $scope, $legalBody);

        return $response;
    }

    /**
     * @param string      $identifier Stripe product ID or slug
     * @param string|null $legalBody  restricts simple products to those sold by this legal body (see LegalBody), not supported by other scopes
     *
     * @return CatalogProduct
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException if the product does not exist in this scope or cannot be purchased by the entity (404)
     * @throws \JsonException
     */
    public function getProduct(RequestContext $requestContext, string $scope, string $identifier, ?string $legalBody = null): array
    {
        /** @var CatalogProduct $response */
        $response = $this->get($requestContext, '/products/' . $scope . '/' . rawurlencode($identifier), $legalBody);

        return $response;
    }

    /**
     * @return array<mixed>
     */
    private function get(RequestContext $requestContext, string $path, ?string $legalBody): array
    {
        $query = $requestContext->toArray();
        if (null !== $legalBody) {
            $query['legalBody'] = $legalBody;
        }

        $response = $this->client->request(
            'GET',
            self::uri($path)->withQuery(http_build_query($query, '', '&', PHP_QUERY_RFC3986)),
        );

        return JsonUtility::decode((string) $response->getBody());
    }
}
