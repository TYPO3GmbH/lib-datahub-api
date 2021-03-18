<?php
declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use T3G\DatahubApiLibrary\Dto\ValidateEltsCredentialsDto;
use T3G\DatahubApiLibrary\Entity\EltsAccessToken;
use T3G\DatahubApiLibrary\Factory\EltsAccessTokenFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class EltsAccessTokenApi extends AbstractApi
{
    use HandlesUuids;

    public function createEltsAccessToken(string $username, EltsAccessToken $eltsAccessToken): EltsAccessToken
    {
        return EltsAccessTokenFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/users/' . mb_strtolower($username) . '/elts-access-token'),
                json_encode($eltsAccessToken, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    public function getEltsAccessToken(string $uuid): EltsAccessToken
    {
        $this->isValidUuidOrThrow($uuid);

        return EltsAccessTokenFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/elts/access-token/' . $uuid),
            )
        );
    }

    public function validateEltsAccessToken(ValidateEltsCredentialsDto $validateEltsCredentialsDto): void
    {
        $this->client->request(
            'POST',
            self::uri('/elts/validate-access-token'),
            json_encode($validateEltsCredentialsDto, JSON_THROW_ON_ERROR)
        );
    }

    public function deleteEltsAccessToken(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/elts/access-token/' . $uuid),
        );
    }
}
