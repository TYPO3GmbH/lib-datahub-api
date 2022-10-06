<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\Certification;
use T3G\DatahubApiLibrary\Entity\User;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\CertificationFactory;
use T3G\DatahubApiLibrary\Factory\CertificationListFactory;
use T3G\DatahubApiLibrary\Factory\UserFactory;
use T3G\DatahubApiLibrary\Factory\UserListFactory;

class ResourceApi extends AbstractApi
{
    /**
     * @param string $username
     *
     * @return User
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getUser(string $username): User
    {
        return UserFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri(sprintf('/resource/user/%s', $username))
            )
        );
    }

    /**
     * @param array<int, string> $usernames
     * @param array<int, string> $filters
     *
     * @return array<int, User>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getUserList(array $usernames, array $filters = []): array
    {
        return UserListFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/resource/user-list'),
                json_encode([
                    'identifiers' => $usernames,
                    'filters' => $filters,
                ], JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @param string $uuid
     *
     * @return Certification
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCertification(string $uuid): Certification
    {
        return CertificationFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri(sprintf('/resource/certification/%s', $uuid))
            )
        );
    }

    /**
     * @param array<int, string> $identifiers
     * @param array<int, string> $filters
     *
     * @return array<int, Certification>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCertificationList(array $identifiers, array $filters = []): array
    {
        return CertificationListFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/resource/certification-list'),
                json_encode([
                    'identifiers' => $identifiers,
                    'filters' => $filters,
                ], JSON_THROW_ON_ERROR)
            )
        );
    }
}
