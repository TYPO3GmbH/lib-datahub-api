<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Dto\CreateEltsPlanDto;
use T3G\DatahubApiLibrary\Dto\ProlongEltsPlanDto;
use T3G\DatahubApiLibrary\Dto\UpdatePaymentStatusDto;
use T3G\DatahubApiLibrary\Entity\EltsMaintainedVersionList;
use T3G\DatahubApiLibrary\Entity\EltsPlan;
use T3G\DatahubApiLibrary\Entity\EltsPlanList;
use T3G\DatahubApiLibrary\Entity\EltsProduct;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\EltsMaintainedVersionFactory;
use T3G\DatahubApiLibrary\Factory\EltsPlanFactory;
use T3G\DatahubApiLibrary\Factory\EltsProductListFactory;
use T3G\DatahubApiLibrary\Utility\JsonUtility;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class EltsPlanApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function createEltsPlanForUser(string $username, CreateEltsPlanDto $eltsPlan): EltsPlan
    {
        return EltsPlanFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/users/' . mb_strtolower($username) . '/elts-plan'),
                json_encode($eltsPlan, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function createEltsPlanForCompany(string $uuid, CreateEltsPlanDto $eltsPlan): EltsPlan
    {
        $this->isValidUuidOrThrow($uuid);

        return EltsPlanFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/companies/' . $uuid . '/elts-plan'),
                json_encode($eltsPlan, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getPlan(string $uuid): EltsPlan
    {
        $this->isValidUuidOrThrow($uuid);

        return EltsPlanFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/elts/plan/' . $uuid)
            )
        );
    }

    /**
     * @param string|null $companyUuid
     *
     * @return EltsPlanList
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getPlans(?string $companyUuid = null): EltsPlanList
    {
        $uri = '/elts/plans';
        if (null !== $companyUuid) {
            $this->isValidUuidOrThrow($companyUuid);
            $uri .= '/' . $companyUuid;
        }

        return EltsPlanFactory::fromResponseDataCollection(
            $this->client->request(
                'GET',
                self::uri($uri)
            )
        );
    }

    /**
     * @return EltsPlanList
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getPlansExport(): EltsPlanList
    {
        $uri = '/elts/plans/export';

        return EltsPlanFactory::fromResponseDataCollection(
            $this->client->request(
                'GET',
                self::uri($uri)
            )
        );
    }

    /**
     * @param string $username
     *
     * @return array<int, string>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     */
    public function getEltsVersionAccess(string $username): array
    {
        $content = $this->client->request(
            'GET',
            self::uri('/elts/version-access/' . mb_strtolower($username))
        )->getBody()->getContents();

        return JsonUtility::decode($content);
    }

    /**
     * @return EltsProduct[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getProducts(): array
    {
        return EltsProductListFactory::fromResponseDataCollection(
            $this->client->request(
                'GET',
                self::uri('/elts/products')
            )
        )->getData();
    }

    /**
     * @return array<string, array{maxRuntimeInYears: int, variants: array<int, array{externalProductId: string, price: float, startYear: int, endYear: int, runtimeIdentifier: string, runtimeInYears: int, runtime: string, validFrom: string, validTo: string}>, version: string, ltsSupport: array{from: string, to: string}}>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     */
    public function getBuyableProducts(string $username, ?string $uuid = null): array
    {
        return JsonUtility::decode((string) $this->client->request(
            'GET',
            self::uri('/elts/buyable-products/' . mb_strtolower($username) . (null !== $uuid ? '/' . $uuid : ''))
        )->getBody());
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deletePlan(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/elts/plan/' . $uuid),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function prolongPlan(ProlongEltsPlanDto $dto): EltsPlan
    {
        return EltsPlanFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/elts/prolong-plan'),
                json_encode($dto, JSON_THROW_ON_ERROR)
            )
        );
    }

    public function updateRuntimePaymentStatus(UpdatePaymentStatusDto $dto): void
    {
        $this->client->request(
            'POST',
            self::uri('/elts/update-runtime-payment-status'),
            json_encode($dto, JSON_THROW_ON_ERROR)
        );
    }

    public function getMaintainedVersions(): EltsMaintainedVersionList
    {
        return EltsMaintainedVersionFactory::fromResponseDataCollection(
            $this->client->request('GET', self::uri('/elts/maintained-versions'))
        );
    }
}
