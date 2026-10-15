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

class SimpleProductApi extends AbstractApi
{
    /**
     * @return mixed[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     */
    public function getProductsForCheckout(RequestContext $requestContext): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/simple-products/checkout')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
        );

        return JsonUtility::decode($response->getBody()->getContents());
    }

    /**
     * @param string $identifier slug or product ID
     *
     * @return mixed[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     */
    public function getProductForCheckout(RequestContext $requestContext, string $legalBody, string $identifier): array
    {
        $response = $this->client->request(
            'GET',
            self::uri(sprintf('/simple-products/checkout/%s/%s', $legalBody, $identifier))
                ->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
        );

        return JsonUtility::decode($response->getBody()->getContents());
    }
}
