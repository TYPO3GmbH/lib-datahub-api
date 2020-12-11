<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\Registration;
use T3G\DatahubApiLibrary\Entity\User;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\RegistrationFactory;
use T3G\DatahubApiLibrary\Factory\UserFactory;

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
                '/registration/pending/' . $registrationCode
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getPendingRegistrations(bool $onlyWhereAdminApprovalRequired = true): array
    {
        $response = $this->client->request(
            'GET',
            '/registration/pending?extended=' . (int)$onlyWhereAdminApprovalRequired
        );

        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['entities'];
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
                '/registration/pending/' . $registrationCode
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
            '/registration/pending/' . $registrationCode
        );
    }
}
