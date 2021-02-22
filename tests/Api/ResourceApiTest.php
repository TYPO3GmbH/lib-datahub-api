<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\ResourceApi;

class ResourceApiTest extends AbstractApiTest
{
    public function testGetUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserResponse.php'
        ]);
        $api = new ResourceApi($this->getClient($handler));
        $response = $api->getUser('oelie-boelie');
        $this->assertEquals('oelie-boelie', $response->getUsername());
        $this->assertCount(2, $response->getAddresses());
        $this->assertCount(2, $response->getPostalAddresses());
        $this->assertCount(2, $response->getLinks());
        $this->assertCount(1, $response->getCertifications());
        $this->assertEquals('ACADEMIC_BRONZE', $response->getMembership()->getSubscriptionSubType());
    }
}
