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
use PHPUnit\Framework\Attributes\DataProvider;
use T3G\DatahubApiLibrary\Api\LicenseApi;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;

class LicenseApiTest extends AbstractApiTestCase
{
    public function testGetLicensesForOrganization(): void
    {
        $container = [];
        $handlerStack = HandlerStack::create(new MockHandler([
            require __DIR__ . '/../Fixtures/GetLicensesResponse.php',
        ]));
        $handlerStack->push(Middleware::history($container));

        $licenses = (new LicenseApi($this->getClient($handlerStack)))->getLicensesForOrganization('1174279d-9995-448a-bf79-ba77c797b9a0');

        self::assertCount(2, $licenses);
        self::assertSame('5f0c4b8e-3d3a-4c1e-9b7a-1e2f3a4b5c6d', $licenses[0]->getUuid());
        self::assertSame('SUITE', $licenses[0]->getType());
        self::assertSame('VALID', $licenses[0]->getStatus());
        self::assertSame('2026-09-01T10:00:00+00:00', $licenses[0]->getCreatedAt()->format(\DateTimeInterface::ATOM));
        self::assertSame('2027-09-01T00:00:00+00:00', $licenses[0]->getValidUntil()->format(\DateTimeInterface::ATOM));
        self::assertNull($licenses[0]->getHistory());
        self::assertSame('0b4ce2c8-0d8b-4b8b-8d5a-3b0c5b6c4a2f', $licenses[0]->getCurrentJti());
        self::assertSame('8a1d2e3f-4b5c-4d6e-8f7a-9b0c1d2e3f4a', $licenses[1]->getUuid());
        self::assertSame('INVALID', $licenses[1]->getStatus());
        self::assertSame('Set to invalid', $licenses[1]->getHistory());
        self::assertNull($licenses[1]->getCurrentJti());

        self::assertCount(1, $container);
        /** @var Request $request */
        $request = reset($container)['request'];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://datahub.typo3.com/api/license/organization/1174279d-9995-448a-bf79-ba77c797b9a0', (string) $request->getUri());
    }

    public function testGetLicensesForOrganizationWithInvalidUuidThrowsException(): void
    {
        $handler = new MockHandler([]);

        $this->expectException(InvalidUuidException::class);
        (new LicenseApi($this->getClient($handler)))->getLicensesForOrganization('not-a-uuid');
    }

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

    public function testCreateLicenseToken(): void
    {
        $container = [];
        $handlerStack = HandlerStack::create(new MockHandler([
            require __DIR__ . '/../Fixtures/CreateLicenseTokenResponse.php',
        ]));
        $handlerStack->push(Middleware::history($container));

        $licenseToken = (new LicenseApi($this->getClient($handlerStack)))->createLicenseToken('0b4ce2c8-0d8b-4b8b-8d5a-3b0c5b6c4a2f');

        self::assertSame('eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJsaWNlbnNlIn0.c2lnbmF0dXJl', $licenseToken->getToken());
        self::assertEquals(new \DateTimeImmutable('2027-09-28T00:00:00+00:00'), $licenseToken->getExpiresAt());

        self::assertCount(1, $container);
        /** @var Request $request */
        $request = reset($container)['request'];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://datahub.typo3.com/api/license/0b4ce2c8-0d8b-4b8b-8d5a-3b0c5b6c4a2f/license-token', (string) $request->getUri());
    }

    public function testCreateLicenseTokenWithInvalidUuidThrowsException(): void
    {
        $handler = new MockHandler([]);

        $this->expectException(InvalidUuidException::class);
        (new LicenseApi($this->getClient($handler)))->createLicenseToken('not-a-uuid');
    }

    public static function failedLicenseTokenCreationDataProvider(): \Iterator
    {
        yield 'access denied' => ['AccessDeniedResponse.php'];
        yield 'license not found' => ['NotFoundResponse.php'];
    }

    #[DataProvider('failedLicenseTokenCreationDataProvider')]
    public function testCreateLicenseTokenThrowsExceptionOnErrorResponse(string $responseFixture): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/' . $responseFixture,
        ]);

        $this->expectException(DatahubResponseException::class);
        (new LicenseApi($this->getClient($handler)))->createLicenseToken('0b4ce2c8-0d8b-4b8b-8d5a-3b0c5b6c4a2f');
    }

    public static function validateLicenseTokenDataProvider(): \Iterator
    {
        yield 'valid token' => ['ValidateLicenseTokenValidResponse.php', true];
        yield 'invalid token' => ['ValidateLicenseTokenInvalidResponse.php', false];
    }

    #[DataProvider('validateLicenseTokenDataProvider')]
    public function testValidateLicenseToken(string $responseFixture, bool $expected): void
    {
        $container = [];
        $handlerStack = HandlerStack::create(new MockHandler([
            require __DIR__ . '/../Fixtures/' . $responseFixture,
        ]));
        $handlerStack->push(Middleware::history($container));

        $valid = (new LicenseApi($this->getClient($handlerStack)))->validateLicenseToken('eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJsaWNlbnNlIn0.c2lnbmF0dXJl');

        self::assertSame($expected, $valid);

        self::assertCount(1, $container);
        /** @var Request $request */
        $request = reset($container)['request'];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://datahub.typo3.com/api/license/license-token/validate', (string) $request->getUri());
        self::assertSame('{"token":"eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJsaWNlbnNlIn0.c2lnbmF0dXJl"}', (string) $request->getBody());
    }

    public function testValidateLicenseTokenThrowsExceptionWhenAccessIsDenied(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/AccessDeniedResponse.php',
        ]);

        $this->expectException(DatahubResponseException::class);
        (new LicenseApi($this->getClient($handler)))->validateLicenseToken('eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJsaWNlbnNlIn0.c2lnbmF0dXJl');
    }
}
