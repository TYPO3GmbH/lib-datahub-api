<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use App\Entity\PendingRegistration;
use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\Registration;
use T3G\DatahubApiLibrary\Entity\User;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\RegistrationFactory;
use T3G\DatahubApiLibrary\Factory\UserFactory;
use T3G\DatahubApiLibrary\Utility\JsonUtility;

class PendingRegistrationApi extends AbstractApi
{
    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getPendingRegistration(string $registrationCode): Registration
    {
        return RegistrationFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/registration/pending/' . $registrationCode)
            )
        );
    }

    /**
     * @return PendingRegistration[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getPendingRegistrations(bool $onlyWhereAdminApprovalRequired = true): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/registration/pending')->withQuery(http_build_query(['extended' => (int) $onlyWhereAdminApprovalRequired]))
        );

        return JsonUtility::decode((string) $response->getBody())['entities'] ?? [];
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function approveRegistration(string $registrationCode): User
    {
        return UserFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/registration/pending/' . $registrationCode)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function declineRegistration(string $registrationCode): void
    {
        $this->client->request(
            'DELETE',
            self::uri('/registration/pending/' . $registrationCode)
        );
    }
}
