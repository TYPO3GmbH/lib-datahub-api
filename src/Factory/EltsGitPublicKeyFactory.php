<?php
declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\EltsGitPublicKey;

class EltsGitPublicKeyFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): EltsGitPublicKey
    {
        return self::fromArray(self::responseToArray($response));
    }

    public static function fromArray(array $data): EltsGitPublicKey
    {
        return (new EltsGitPublicKey())
            ->setUuid($data['uuid'])
            ->setName($data['name'])
            ->setEltsVersion($data['eltsVersion'])
            ->setPublicKey($data['publicKey']);
    }
}
