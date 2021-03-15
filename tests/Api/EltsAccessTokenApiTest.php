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

class EltsAccessTokenApiTest extends AbstractApiTest
{
    public function testCreateEltsAccessToken(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEltsAccessTokenResponse.php'
        ]);
        $response = (new EltsAccessTokenApi($this->getClient($handler)))->createEltsAccessToken('oelie-boelie');

        self::assertEquals('oelie', $response->getUser()->getUsername());
        self::assertEquals('aaabbbccc', $response->getToken());
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
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
    }
}
