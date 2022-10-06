<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\SubscriptionApi;

class SubscriptionApiTest extends AbstractApiTest
{
    public function testGetSubscription(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetSubscriptionResponse.php',
        ]);
        $api = new SubscriptionApi($this->getClient($handler));
        $response = $api->getSubscription('11111111-1111-1111-1111-111111111111');
        self::assertEquals('11111111-1111-1111-1111-111111111111', $response->getUuid());
        self::assertEquals('BRONZE', $response->getSubscriptionSubType());
        self::assertEquals('membership', $response->getSubscriptionType());
    }

    public function testTransferSubscriptionToOrganization(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetSubscriptionResponse.php',
        ]);
        $api = new SubscriptionApi($this->getClient($handler));
        $response = $api->transferSubscriptionToOrganization('11111111-1111-1111-1111-111111111111', '11111111-1111-1111-1111-111111111111');
        self::assertEquals('11111111-1111-1111-1111-111111111111', $response->getUuid());
        self::assertEquals('BRONZE', $response->getSubscriptionSubType());
        self::assertEquals('membership', $response->getSubscriptionType());
    }
}
