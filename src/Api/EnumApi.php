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
use T3G\DatahubApiLibrary\Utility\JsonUtility;

class EnumApi extends AbstractApi
{
    /**
     * @return array<string, string>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCertificationStatusses(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/certification/status'),
        );

        return JsonUtility::decode((string) $response->getBody())['data'] ?? [];
    }

    /**
     * @return array<string, string>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCertificationTypes(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/certification/type'),
        );

        return JsonUtility::decode((string) $response->getBody())['data'] ?? [];
    }

    /**
     * @return array<string, string>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getEmployeeRoles(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/employee/role'),
        );

        return JsonUtility::decode((string) $response->getBody())['data'] ?? [];
    }

    /**
     * @return array<string, string>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getMembershipTypes(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/membership/type'),
        );

        return JsonUtility::decode((string) $response->getBody())['data'] ?? [];
    }

    /**
     * @return array<string, string>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getLinkTypes(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/link/types'),
        );

        return JsonUtility::decode((string) $response->getBody())['data'] ?? [];
    }

    /**
     * @return array<string, string>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getSubscriptionTypes(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/subscription/type'),
        );

        return JsonUtility::decode((string) $response->getBody())['data'] ?? [];
    }

    /**
     * @return array<string,string>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getSubscriptionStatus(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/subscription/status'),
        );

        return JsonUtility::decode((string) $response->getBody())['data'] ?? [];
    }

    /**
     * @return array<string, string>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCompanyDeletionPreCheckTypes(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/company/deletion-pre-check-type'),
        );

        return JsonUtility::decode((string) $response->getBody())['data'] ?? [];
    }

    /**
     * @return array<string, string>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getTransferableTypes(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/transferable/type'),
        );

        return JsonUtility::decode((string) $response->getBody())['data'] ?? [];
    }
}
