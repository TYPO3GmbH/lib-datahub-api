<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Client\DataHubClient;
use T3G\DatahubApiLibrary\Entity\Link;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\LinkFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class LinkApi
{
    use HandlesUuids;

    private DataHubClient $client;

    public function __construct(DataHubClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getLink(string $uuid): Link
    {
        $this->isValidUuidOrThrow($uuid);

        return LinkFactory::fromResponse(
            $this->client->request(
                'GET',
                '/links/' . $uuid
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function createLink(string $username, Link $link): Link
    {
        return LinkFactory::fromResponse(
            $this->client->request(
                'POST',
                '/users/' . urlencode(mb_strtolower($username)) . '/links',
                json_encode($link, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function updateLink(string $uuid, Link $link): Link
    {
        $this->isValidUuidOrThrow($uuid);

        return LinkFactory::fromResponse(
            $this->client->request(
                'PUT',
                '/links/' . $uuid,
                json_encode($link, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deleteLink(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            '/links/' . $uuid
        );
    }
}
