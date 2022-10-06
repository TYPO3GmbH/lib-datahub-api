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

class GDPRApi extends AbstractApi
{
    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function requestUserDeletion(string $username, string $otrsIssue, string $comment): void
    {
        $this->client->request(
            'POST',
            self::uri('/users/' . mb_strtolower($username) . '/delete'),
            json_encode(['otrsIssue' => $otrsIssue, 'comment' => $comment], JSON_THROW_ON_ERROR, 512)
        );
    }

    /**
     * @return array<string, mixed>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function confirmUserDeletion(string $username): array
    {
        $response = $this->client->request(
            'DELETE',
            self::uri('/users/' . mb_strtolower($username))
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    /**
     * @return array<string, mixed>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getUsersInDeletionProcess(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/reserved-users/pending-deletions')
        );

        return JsonUtility::decode((string) $response->getBody())['entities'] ?? [];
    }
}
