<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\OldUserApi;

class OldUserApiTest extends AbstractApiTest
{
    public function testSearch(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/PostSearchOldUsersResponse.php'
        ]);
        $api = new OldUserApi($this->getClient($handler));
        $response = $api->search('neo');
        $this->assertIsArray($response);
        $this->assertCount(3, $response);
        $entity = array_pop($response);
        $this->assertArrayHasKey('username', $entity);
        $this->assertArrayHasKey('email', $entity);
        $this->assertArrayHasKey('deletedBy', $entity);
        $this->assertArrayHasKey('deleteDate', $entity);
        $this->assertArrayHasKey('gitlabIssue', $entity);
        $this->assertArrayHasKey('otrsIssue', $entity);
        $this->assertArrayHasKey('comment', $entity);
    }

    public function testReEnable(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponse.php'
        ]);
        $api = new OldUserApi($this->getClient($handler));
        $response = $api->reEnable('oelie-boelie');
        $this->assertEquals('oelie-boelie', $response->getUsername());
        $this->assertCount(2, $response->getAddresses());
        $this->assertCount(2, $response->getLinks());
        $this->assertCount(1, $response->getCertifications());
        $this->assertEquals('COMMUNITY', $response->getMembership()->getType());
    }
}
