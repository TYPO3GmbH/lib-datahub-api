<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\ReservedUser;
use T3G\DatahubApiLibrary\Entity\User;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\ReservedUserFactory;
use T3G\DatahubApiLibrary\Factory\UserFactory;
use T3G\DatahubApiLibrary\Utility\JsonUtility;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class OldUserApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @return ReservedUser[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function search(string $search): array
    {
        $response = $this->client->request(
            'POST',
            self::uri('/reserved-users/search'),
            json_encode(['term' => $search], JSON_THROW_ON_ERROR, 512)
        );

        return JsonUtility::decode((string) $response->getBody())['entities'] ?? [];
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     * @throws \T3G\DatahubApiLibrary\Exception\InvalidUuidException
     */
    public function getReservedUser(string $uuid): ReservedUser
    {
        $this->isValidUuidOrThrow($uuid);

        return ReservedUserFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/reserved-users/' . $uuid)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     * @throws \T3G\DatahubApiLibrary\Exception\InvalidUuidException
     *
     * @internal
     */
    public function checkEmailAddress(string $uuid): bool
    {
        $this->isValidUuidOrThrow($uuid);

        $response = $this->client->request(
            'GET',
            self::uri('/reserved-users/' . $uuid . '/email-check')
        );
        $responseContent = JsonUtility::decode((string) $response->getBody());

        return true === $responseContent['is_usable'];
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function reEnable(string $username, ?string $emailAddress = null): User
    {
        $query = http_build_query([
            'email' => $emailAddress,
        ]);

        return UserFactory::fromResponse(
            $response = $this->client->request(
                'POST',
                self::uri('/users/' . mb_strtolower($username) . '/reenable')->withQuery($query),
            )
        );
    }
}
