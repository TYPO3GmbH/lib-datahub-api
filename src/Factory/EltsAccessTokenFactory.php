<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\EltsAccessToken;

/**
 * @extends AbstractFactory<EltsAccessToken>
 */
class EltsAccessTokenFactory extends AbstractFactory
{
    public static function fromArray(array $data): EltsAccessToken
    {
        $token = (new EltsAccessToken())
            ->setCreatedAt(new \DateTime($data['createdAt']))
            ->setName($data['name'] ?? '')
            ->setDescription($data['description'] ?? '')
            ->setToken($data['token'])
            ->setUuid($data['uuid']);

        if (isset($data['user'])) {
            $token->setUser(UserFactory::fromArray($data['user']));
        }

        return $token;
    }
}
