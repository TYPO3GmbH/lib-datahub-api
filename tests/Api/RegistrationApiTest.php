<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\RegistrationApi;
use T3G\DatahubApiLibrary\Entity\Registration;

class RegistrationApiTest extends AbstractApiTest
{
    public function testRegistration(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/PutRegistrationResponse.php',
        ]);
        $api = new RegistrationApi($this->getClient($handler));
        $response = $api->register($this->getTestRegistration());
        self::assertEquals('oelie-boelie', $response->getUsername());
        self::assertEquals('oelie@boelie.nl', $response->getEmail());
        self::assertEquals('Oelie', $response->getFirstName());
        self::assertEquals('Boelie', $response->getLastName());
        self::assertEquals('lidl', $response->getLocation());
        self::assertEquals('a9fde411-e46f-4fca-80f4-347bf3b57ca3', $response->getRegistrationCode());
        self::assertEquals('2020-04-13T14:24:21+00:00', $response->getValidUntil()->format(\DateTimeInterface::ATOM));
    }

    public function testConfirmRegistration(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponse.php',
            require __DIR__ . '/../Fixtures/ConfirmRegistrationExtendedResponse.php',
        ]);
        $api = new RegistrationApi($this->getClient($handler));
        $user = $api->confirmRegistration('a9fde411-e46f-4fca-80f4-347bf3b57ca3');
        self::assertEquals('oelie-boelie', $user->getUsername());

        $user = $api->confirmRegistration('a9fde411-e46f-4fca-80f4-347bf3b57ca3');
        self::assertEquals('oelie-boelie', $user->getUsername());
    }

    public function getTestRegistration(): Registration
    {
        return (new Registration())
            ->setUsername('oelie-boelie')
            ->setFirstName('Oelie')
            ->setLastName('Boelie')
            ->setLocation('lidl')
            ->setEmail('oelie@boelie.nl')
            ->setPassword('SomeVeryStrongPassword')
            ->addApprovedDocument('test', '1.0.0');
    }
}
