<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\ReleaseNotificationApi;
use T3G\DatahubApiLibrary\Dto\CreateReleaseNotificationDto;
use T3G\DatahubApiLibrary\Entity\ReleaseNotification;

class ReleaseNotificationApiTest extends AbstractApiTestCase
{
    public function testCreateReleaseNotificationForInstance(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/CreateReleaseNotificationResponse.php',
        ]);

        $releaseNotification = new CreateReleaseNotificationDto();
        $releaseNotification->name = 'Markus Miller';
        $releaseNotification->email = 'markus.miller@typo3.com';
        $releaseNotification->instance = '00000000-0000-0000-0000-000000000000';
        $response = (new ReleaseNotificationApi($this->getClient($handler)))
            ->createReleaseNotification($releaseNotification);

        self::assertEquals($releaseNotification->name, $response->getName());
        self::assertEquals($releaseNotification->email, $response->getEmail());
        self::assertEquals($releaseNotification->instance, $response->getEltsInstance()->getUuid());
    }

    public function testGetReleaseNotification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetReleaseNotificationResponse.php',
        ]);

        $releaseNotification = $this->getTestReleaseNotificationForGet();
        $response = (new ReleaseNotificationApi($this->getClient($handler)))
            ->getReleaseNotification('00000000-0000-0000-0000-000000000000');

        self::assertEquals($releaseNotification->getUuid(), $response->getUuid());
        self::assertEquals($releaseNotification->getName(), $response->getName());
        self::assertEquals($releaseNotification->getEmail(), $response->getEmail());
        self::assertEquals($releaseNotification->getAccepted(), $response->getAccepted());
    }

    public function testConfirmReleaseNotification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/ConfirmReleaseNotificationResponse.php',
        ]);

        $releaseNotification = $this->getTestReleaseNotificationForConfirm();
        $response = (new ReleaseNotificationApi($this->getClient($handler)))
            ->confirmReleaseNotification('00000000-0000-0000-0000-000000000000');

        self::assertEquals($releaseNotification->getUuid(), $response->getUuid());
        self::assertEquals($releaseNotification->getName(), $response->getName());
        self::assertEquals($releaseNotification->getEmail(), $response->getEmail());
        self::assertEquals($releaseNotification->getAccepted(), $response->getAccepted());
    }

    public function testDeleteReleaseNotification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php',
        ]);

        $api = new ReleaseNotificationApi($this->getClient($handler));
        try {
            $api->deleteReleaseNotification('d209090d-be9e-4034-82e8-7a7ebb5b776c');
            $anExceptionWasThrown = false;
        } catch (\Exception) {
            $anExceptionWasThrown = true;
        }

        self::assertFalse($anExceptionWasThrown);
    }

    private function getTestReleaseNotificationForGet(): ReleaseNotification
    {
        return (new ReleaseNotification())
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setName('From Plan 1')
            ->setEmail('from-plan1@typo3.com')
            ->setAccepted(false);
    }

    private function getTestReleaseNotificationForConfirm(): ReleaseNotification
    {
        return (new ReleaseNotification())
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setName('From Plan 1')
            ->setEmail('from-plan1@typo3.com')
            ->setAccepted(true);
    }
}
