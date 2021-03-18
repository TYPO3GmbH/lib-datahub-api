<?php
declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\EltsAccessTokenApi;
use T3G\DatahubApiLibrary\Entity\EltsAccessToken;

class EltsAccessTokenApiTest extends AbstractApiTest
{
    public function testCreateEltsAccessToken(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEltsAccessTokenResponse.php'
        ]);
        $eltsToken = new EltsAccessToken();
        $eltsToken->setName('Test');
        $eltsToken->setDescription('Test-Description');
        $response = (new EltsAccessTokenApi($this->getClient($handler)))->createEltsAccessToken('oelie-boelie', $eltsToken);

        self::assertEquals('oelie', $response->getUser()->getUsername());
        self::assertEquals('aaabbbccc', $response->getToken());
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('Test', $response->getName());
        self::assertEquals('Test-Description', $response->getDescription());
    }

    public function testGetEltsAccessToken(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEltsAccessTokenResponse.php'
        ]);
        $response = (new EltsAccessTokenApi($this->getClient($handler)))->getEltsAccessToken('00000000-0000-0000-0000-000000000000');

        self::assertEquals('oelie', $response->getUser()->getUsername());
        self::assertEquals('aaabbbccc', $response->getToken());
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('Test', $response->getName());
        self::assertEquals('Test-Description', $response->getDescription());
    }
}
