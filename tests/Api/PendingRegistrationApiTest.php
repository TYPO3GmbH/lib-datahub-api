<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\PendingRegistrationApi;

class PendingRegistrationApiTest extends AbstractApiTest
{
    public function testGetPendingRegistration(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetPendingRegistrationResponse.php',
        ]);
        $api = new PendingRegistrationApi($this->getClient($handler));
        $response = $api->getPendingRegistration('00000000-0000-0000-0000-000000000000');
        self::assertEquals('oelie-boelie', $response->getUsername());
    }

    public function testGetPendingRegistrations(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetPendingRegistrationsResponse.php',
        ]);
        $api = new PendingRegistrationApi($this->getClient($handler));
        $response = $api->getPendingRegistrations();
        self::assertCount(1, $response);
        self::assertEquals('oelie-boelie', $response[0]['username']);
    }

    public function testApproveRegistration(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponse.php',
        ]);
        $api = new PendingRegistrationApi($this->getClient($handler));
        $response = $api->approveRegistration('00000000-0000-0000-0000-000000000000');
        self::assertEquals('oelie-boelie', $response->getUsername());
    }

    public function testDeclineRegistration(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php',
        ]);
        $api = new PendingRegistrationApi($this->getClient($handler));
        try {
            $api->declineRegistration('00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }
        self::assertFalse($anExceptionWasThrown);
    }
}
