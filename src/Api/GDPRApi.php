<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Client\DataHubClient;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;

class GDPRApi
{
    private DataHubClient $client;

    public function __construct(DataHubClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function requestUserDeletion(string $username, string $otrsIssue, string $comment): void
    {
        $this->client->request(
            'POST',
            '/users/' . urlencode(mb_strtolower($username)) . '/delete',
            json_encode(['otrsIssue' => $otrsIssue, 'comment' => $comment], JSON_THROW_ON_ERROR, 512)
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function confirmUserDeletion(string $username): array
    {
        $response = $this->client->request(
            'DELETE',
            '/users/' . urlencode(mb_strtolower($username))
        );

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getUsersInDeletionProcess(): array
    {
        $response = $this->client->request(
            'GET',
            '/reserved-users/pending-deletions'
        );

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR)['entities'];
    }
}
