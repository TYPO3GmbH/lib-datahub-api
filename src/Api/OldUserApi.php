<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\User;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\UserFactory;

class OldUserApi extends AbstractApi
{
    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function search(string $search): array
    {
        $response = $this->client->request(
            'POST',
            '/reserved-users/search',
            json_encode(['term' => $search], JSON_THROW_ON_ERROR, 512)
        );

        return json_decode(
            $response->getBody()->getContents(),
            true,
            512,
            JSON_THROW_ON_ERROR
        )['entities'];
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function reEnable(string $username): User
    {
        return UserFactory::fromResponse(
            $response = $this->client->request(
                'POST',
                '/users/' . rawurlencode(mb_strtolower($username)) . '/reenable',
            )
        );
    }
}
