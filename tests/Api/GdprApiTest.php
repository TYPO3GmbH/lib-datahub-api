<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\GDPRApi;

class GdprApiTest extends AbstractApiTestCase
{
    public function testRequestUserDeletion(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php',
        ]);
        $api = new GDPRApi($this->getClient($handler));
        try {
            $api->requestUserDeletion('oelie-boelie', 'BLA-123', 'Comment');
            $anExceptionWasThrown = false;
        } catch (\Exception) {
            $anExceptionWasThrown = true;
        }
        self::assertFalse($anExceptionWasThrown);
    }

    public function testConfirmUserDeletion(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/ConfirmDeleteUserResponse.php',
        ]);
        $api = new GDPRApi($this->getClient($handler));
        $data = $api->confirmUserDeletion('oelie-boelie');

        self::assertArrayHasKey('username', $data);
        self::assertArrayHasKey('otrsIssue', $data);
        self::assertArrayHasKey('deleteDate', $data);
        self::assertArrayHasKey('comment', $data);
    }

    public function testGetUsersInDeletionProcess(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetGdprUsersInProgressResponse.php',
        ]);
        $api = new GDPRApi($this->getClient($handler));
        $data = $api->getUsersInDeletionProcess();

        self::assertCount(1, $data);
    }
}
