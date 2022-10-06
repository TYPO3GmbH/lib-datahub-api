<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\EltsGitPublicTokenApi;
use T3G\DatahubApiLibrary\Entity\EltsGitPublicKey;

class EltsGitPublicKeyApiTest extends AbstractApiTest
{
    public function testCreateGitPublicKeyToken(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetGitPublicKeyTokenResponse.php',
        ]);
        $eltsGitPublicKey = new EltsGitPublicKey();
        $eltsGitPublicKey->setName('Test Key');
        $eltsGitPublicKey->setEltsVersion('7.6');
        $eltsGitPublicKey->setPublicKey('ssh-rsa AAAAA....');
        $response = (new EltsGitPublicTokenApi($this->getClient($handler)))->createEltsGitPublicKey('oelie-boelie', $eltsGitPublicKey);

        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('Test Key', $response->getName());
        self::assertEquals('7.6', $response->getEltsVersion());
        self::assertEquals('ssh-rsa AAAAA....', $response->getPublicKey());
    }

    public function testGetGitPublicKeyToken(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetGitPublicKeyTokenResponse.php',
        ]);
        $response = (new EltsGitPublicTokenApi($this->getClient($handler)))->getEltsGitPublicKey('00000000-0000-0000-0000-000000000000');

        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('Test Key', $response->getName());
        self::assertEquals('7.6', $response->getEltsVersion());
        self::assertEquals('ssh-rsa AAAAA....', $response->getPublicKey());
    }
}
