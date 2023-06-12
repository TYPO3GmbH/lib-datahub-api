<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use T3G\DatahubApiLibrary\Entity\EltsGitPublicKey;
use T3G\DatahubApiLibrary\Factory\EltsGitPublicKeyFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class EltsGitPublicTokenApi extends AbstractApi
{
    use HandlesUuids;

    public function createEltsGitPublicKey(string $username, EltsGitPublicKey $eltsGitPublicKey): EltsGitPublicKey
    {
        return EltsGitPublicKeyFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/users/' . mb_strtolower($username) . '/elts-git-public-key'),
                json_encode($eltsGitPublicKey, JSON_THROW_ON_ERROR)
            )
        );
    }

    public function getEltsGitPublicKey(string $uuid): EltsGitPublicKey
    {
        $this->isValidUuidOrThrow($uuid);

        return EltsGitPublicKeyFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/elts-git-public-key/' . $uuid),
            )
        );
    }

    public function deleteEltsGitPublicKey(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/elts-git-public-key/' . $uuid),
        );
    }
}
