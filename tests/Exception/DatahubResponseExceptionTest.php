<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Exception;

use GuzzleHttp\Handler\MockHandler;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Api\PendingRegistrationApi;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Tests\Api\AbstractApiTest;

class DatahubResponseExceptionTest extends AbstractApiTest
{
    public function testException(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/AccessDeniedResponse.php',
        ]);
        try {
            $api = new PendingRegistrationApi($this->getClient($handler));
            $api->getPendingRegistrations();
        } catch (DatahubResponseException $e) {
            self::assertInstanceOf(ResponseInterface::class, $e->getResponse());
            self::assertInstanceOf(RequestInterface::class, $e->getRequest());
        }
    }
}
