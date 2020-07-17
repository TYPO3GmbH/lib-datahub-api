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

class PasswordResetApi
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
    public function requestPasswordReset(string $username): void
    {
        $this->client->request(
            'PUT',
            '/users/' . urlencode(mb_strtolower($username)) . '/reset-password'
        );
    }
}
