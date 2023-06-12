<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\BitMaskApi;

class BitMaskApiTest extends AbstractApiTestCase
{
    public function testGetAddressTypes(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetAddressTypesBitMaskResponse.php',
        ]);
        $response = (new BitMaskApi($this->getClient($handler)))->getAddressTypes();
        self::assertIsArray($response);
        self::assertContains('Invoice', $response);
        self::assertArrayHasKey(1, $response);
        self::assertContains('Delivery', $response);
        self::assertArrayHasKey(256, $response);
        self::assertContains('Postal', $response);
        self::assertArrayHasKey(16, $response);
    }
}
