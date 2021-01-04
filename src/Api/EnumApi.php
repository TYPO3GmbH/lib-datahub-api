<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;

class EnumApi extends AbstractApi
{
    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCertificationStatusses(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/certification/status'),
        );

        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['data'];
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCertificationTypes(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/certification/type'),
        );

        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['data'];
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getEmployeeRoles(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/employee/role'),
        );

        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['data'];
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getMembershipTypes(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/membership/type'),
        );

        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['data'];
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getLinkTypes(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/link/icons'),
        );

        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['data'];
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getSubscriptionTypes(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/subscription/type'),
        );

        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['data'];
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @phpstan-return array<string,string>
     */
    public function getSubscriptionStatus(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/subscription/status'),
        );

        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['data'];
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @phpstan-return array<string,string>
     */
    public function getCompanyDeletionPreCheckTypes(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/enums/company/deletion-pre-check-type'),
        );

        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['data'];
    }
}
