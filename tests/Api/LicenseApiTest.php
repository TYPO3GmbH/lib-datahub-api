<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use T3G\DatahubApiLibrary\Api\LicenseApi;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;

class LicenseApiTest extends AbstractApiTestCase
{
    public function testCreateDownloadToken(): void
    {
        $container = [];
        $handlerStack = HandlerStack::create(new MockHandler([
            require __DIR__ . '/../Fixtures/CreateDownloadTokenResponse.php',
        ]));
        $handlerStack->push(Middleware::history($container));

        $licenseToken = (new LicenseApi($this->getClient($handlerStack)))->createDownloadToken();

        self::assertSame('eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJkb3dubG9hZCJ9.c2lnbmF0dXJl', $licenseToken->getToken());
        self::assertEquals(new \DateTimeImmutable('2026-09-23T12:00:30+00:00'), $licenseToken->getExpiresAt());

        self::assertCount(1, $container);
        /** @var Request $request */
        $request = reset($container)['request'];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://datahub.typo3.com/api/license/download-token', (string) $request->getUri());
    }

    public function testCreateDownloadTokenThrowsExceptionWhenAccessIsDenied(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/AccessDeniedResponse.php',
        ]);

        $this->expectException(DatahubResponseException::class);
        (new LicenseApi($this->getClient($handler)))->createDownloadToken();
    }
}
