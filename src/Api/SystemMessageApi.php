<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\SystemMessage;
use T3G\DatahubApiLibrary\Entity\SystemMessageList;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\SystemMessageFactory;
use T3G\DatahubApiLibrary\Factory\SystemMessageListFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class SystemMessageApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getSystemMessages(): SystemMessageList
    {
        return SystemMessageListFactory::fromResponseDataCollection(
            $this->client->request(
                'GET',
                self::uri('/system-messages')
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getActiveSystemMessages(): SystemMessageList
    {
        return SystemMessageListFactory::fromResponseDataCollection(
            $this->client->request(
                'GET',
                self::uri('/system-messages/active')
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getUnviewedSystemMessagesByUser(string $username): SystemMessageList
    {
        return SystemMessageListFactory::fromResponseDataCollection(
            $this->client->request(
                'GET',
                self::uri(sprintf('/users/%s/system-messages', $username))
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function createSystemMessageView(string $systemMessageUuid, string $username): void
    {
        $this->client->request(
            'POST',
            self::uri(sprintf('/users/%s/system-messages/%s/viewed', $username, $systemMessageUuid))
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getSystemMessage(string $uuid): SystemMessage
    {
        $this->isValidUuidOrThrow($uuid);

        return SystemMessageFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/system-messages/' . $uuid)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function createSystemMessage(SystemMessage $systemMessage): SystemMessage
    {
        return SystemMessageFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/system-messages'),
                json_encode($systemMessage, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function updateSystemMessage(string $uuid, SystemMessage $systemMessage): SystemMessage
    {
        $this->isValidUuidOrThrow($uuid);

        return SystemMessageFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/system-messages/' . $uuid),
                json_encode($systemMessage, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deleteSystemMessage(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/system-messages/' . $uuid)
        );
    }
}
