<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Demand\CertificationSearchDemand;
use T3G\DatahubApiLibrary\Entity\Certification;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\CertificationFactory;
use T3G\DatahubApiLibrary\Factory\CertificationListFactory;
use T3G\DatahubApiLibrary\Request\RequestContext;
use T3G\DatahubApiLibrary\Utility\JsonUtility;

class CertificationApi extends AbstractApi
{
    /**
     * @param array{priceId: string, quantity: int, metadata?: array<string, mixed>}[] $items
     *
     * @return array{customerSessionClientSecret: string, currency: string, amount: int, products: array<mixed>}[]
     *
     * @deprecated Use CheckoutApi->createCheckoutSession() instead
     */
    public function createCheckoutSession(RequestContext $requestContext, array $items): array
    {
        return (new CheckoutApi($this->client))->createCheckoutSession($requestContext, 'certification', $items);
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
        return (new CheckoutApi($this->client))->getPricingInformation($requestContext, 'certification', $addressUuid, $items);
    }

    /**
     * @param array{items: array{priceId: string, quantity: int, metadata?: array<string, mixed>}[], addressUuid: string, referenceNumber?: string} $payload
     *
     * @return array{payment_intent_client_secret: string}
     *
     * @deprecated Use CheckoutApi->finalizeOrder() instead
     */
    public function finalizeOrder(RequestContext $requestContext, array $payload): array
    {
        return (new CheckoutApi($this->client))->finalizeOrder($requestContext, 'certification', $payload);
    }

    public function getProducts(RequestContext $requestContext): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/certifications/products')->withQuery(http_build_query($requestContext->toArray(), encoding_type: PHP_QUERY_RFC3986)),
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    /**
     * @param array<string, string> $filterAttributes
     *
     * @return Certification[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCertifications(array $filterAttributes = []): array
    {
        return CertificationListFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/certifications/')->withQuery(http_build_query($filterAttributes))
            )
        );
    }

    /**
     * @param CertificationSearchDemand $searchDemand
     *
     * @return Certification[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCertificationsFiltered(CertificationSearchDemand $searchDemand): array
    {
        return CertificationListFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/certifications/'),
                json_encode($searchDemand, JSON_THROW_ON_ERROR)
            )
        );
    }

    public function getCertification(string $uuid, bool $withHistory = false): Certification
    {
        return CertificationFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/certifications/' . $uuid)->withQuery('withHistory=' . (int) $withHistory)
            )
        );
    }

    public function setResult(string $uuid, string $result): Certification
    {
        return CertificationFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/certifications/' . $uuid . '/test-result'),
                json_encode([
                    'examTestResult' => $result,
                ], JSON_THROW_ON_ERROR)
            )
        );
    }

    public function startCertification(string $uuid): Certification
    {
        return CertificationFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/certifications/' . $uuid . '/start'),
                json_encode([
                    'examDate' => (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM),
                ], JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @return Certification[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCertificationsForPrint(): array
    {
        return CertificationListFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/certifications/get-for-print'),
            )
        );
    }

    /**
     * @return Certification[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCertificationsForListing(?string $certificationType = null): array
    {
        $queryString = '';
        if (!empty($certificationType)) {
            $queryString = 'type=' . $certificationType;
        }

        return CertificationListFactory::fromResponse($this->client->request(
            'GET',
            self::uri('/certifications/get-for-listing')->withQuery($queryString),
        ));
    }

    /**
     * @param string[] $uuids
     *
     * @throws \JsonException
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function setCertificationsPrintDate(array $uuids): void
    {
        $this->client->request(
            'PUT',
            self::uri('/certifications/send-to-print'),
            json_encode([
                'certifications' => $uuids,
            ], JSON_THROW_ON_ERROR)
        );
    }

    /**
     * @param array<string, string|null> $postFormattedAddress
     */
    public function setAddress(string $uuid, array $postFormattedAddress, string $address): Certification
    {
        return CertificationFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/certifications/' . $uuid . '/address'),
                json_encode([
                    'postFormattedAddress' => $postFormattedAddress,
                    'address' => $address,
                ], JSON_THROW_ON_ERROR)
            )
        );
    }

    public function updateCertification(string $uuid, Certification $certification): Certification
    {
        return CertificationFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/certifications/' . $uuid),
                json_encode($certification, JSON_THROW_ON_ERROR)
            )
        );
    }

    public function deleteCertification(string $uuid): void
    {
        $this->client->request('DELETE', self::uri('/certifications/' . $uuid));
    }
}
