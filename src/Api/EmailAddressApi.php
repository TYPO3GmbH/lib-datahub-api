<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\EmailAddress;
use T3G\DatahubApiLibrary\Entity\UserEmail;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\EmailAddressFactory;
use T3G\DatahubApiLibrary\Factory\UserEmailListFactory;
use T3G\DatahubApiLibrary\Utility\JsonUtility;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class EmailAddressApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @return UserEmail[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getAllUserEmailAddresses(): array
    {
        return UserEmailListFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/emails/users-all'),
            )
        );
    }

    /**
     * @param string $uuid
     *
     * @return EmailAddress
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getEmailAddress(string $uuid): EmailAddress
    {
        $this->isValidUuidOrThrow($uuid);

        return EmailAddressFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/emails/' . $uuid)
            )
        );
    }

    /**
     * @param string $email
     *
     * @return bool
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     */
    public function isUserEmailAddressUnique(string $email): bool
    {
        $response = $this->client->request(
            'GET',
            self::uri('/emails/' . $email . '/unique')
        );

        $responseContent = JsonUtility::decode((string) $response->getBody());

        return true === $responseContent['is_unique'];
    }

    /**
     * @param string       $uuid
     * @param EmailAddress $emailAddress
     *
     * @return EmailAddress
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     * @throws \JsonException
     */
    public function updateEmailAddress(string $uuid, EmailAddress $emailAddress): EmailAddress
    {
        $this->isValidUuidOrThrow($uuid);

        return EmailAddressFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/emails/' . $uuid),
                json_encode($emailAddress, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @param string $uuid
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deleteEmailAddress(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/emails/' . $uuid)
        );
    }
}
