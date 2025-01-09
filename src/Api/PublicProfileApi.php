<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\PublicProfile;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\PublicProfileFactory;

class PublicProfileApi extends AbstractApi
{
    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getPublicProfile(string $username): PublicProfile
    {
        return PublicProfileFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/users/' . mb_strtolower($username) . '/public-profile')
            )
        );
    }
}
