<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\OrderApi;
use T3G\DatahubApiLibrary\Entity\Order;

class OrderApiTest extends AbstractApiTest
{
    public function testGetOrder(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOrderResponse.php'
        ]);
        $response = (new OrderApi($this->getClient($handler)))
            ->getOrder('00000000-0000-0000-0000-000000000000');
        $this->assertEquals('A12345', $response->getOrderNumber());
        $this->assertIsArray($response->getPayload());
        $this->assertSame(['items' => [['foo' => 'bar']]], $response->getPayload());
        $this->assertCount(1, $response->getInvoices());
    }

    public function testCreateOrderForUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOrderResponse.php'
        ]);
        $response = (new OrderApi($this->getClient($handler)))
            ->createOrderForUser('oelie-boelie', $this->getTestOrder());
        $this->assertEquals('A12345', $response->getOrderNumber());
        $this->assertIsArray($response->getPayload());
        $this->assertSame(['items' => [['foo' => 'bar']]], $response->getPayload());
    }

    public function testCreateOrderForCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOrderResponse.php'
        ]);
        $response = (new OrderApi($this->getClient($handler)))
            ->createOrderForCompany('00000000-0000-0000-0000-000000000000', $this->getTestOrder());
        $this->assertEquals('A12345', $response->getOrderNumber());
        $this->assertIsArray($response->getPayload());
        $this->assertSame(['items' => [['foo' => 'bar']]], $response->getPayload());
    }

    public function testUpdateOrder(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOrderResponse.php'
        ]);
        $response = (new OrderApi($this->getClient($handler)))
            ->updateOrder('00000000-0000-0000-0000-000000000000', $this->getTestOrder());
        $this->assertEquals('A12345', $response->getOrderNumber());
        $this->assertIsArray($response->getPayload());
        $this->assertSame(['items' => [['foo' => 'bar']]], $response->getPayload());
    }

    public function testDeleteMailAddressFilter(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
        ]);
        $api = new OrderApi($this->getClient($handler));
        try {
            $api->deleteOrder('00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }
        $this->assertFalse($anExceptionWasThrown);
    }

    private function getTestOrder(): Order
    {
        return (new Order())
            ->setOrderNumber('A12345')
            ->setPayload([
                'items' => [
                    ['foo' => 'bar']
                ]
            ]);
    }
}
