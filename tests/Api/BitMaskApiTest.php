<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\BitMaskApi;

class BitMaskApiTest extends AbstractApiTest
{
    public function testGetAddressTypes(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetAddressTypesBitMaskResponse.php'
        ]);
        $response = (new BitMaskApi($this->getClient($handler)))->getAddressTypes();
        $this->assertIsArray($response);
        $this->assertContains('Invoice', $response);
        $this->assertArrayHasKey(1, $response);
        $this->assertContains('Delivery', $response);
        $this->assertArrayHasKey(256, $response);
        $this->assertContains('Postal', $response);
        $this->assertArrayHasKey(16, $response);
    }
}
