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

class ResourceApi extends AbstractApi
{
    /**
     * @param string $username
     * @return User
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
}
