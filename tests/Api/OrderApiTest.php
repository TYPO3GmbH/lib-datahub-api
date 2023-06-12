<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Api\OrderApi;
use T3G\DatahubApiLibrary\Demand\OrderSearchDemand;
use T3G\DatahubApiLibrary\Entity\Invoice;
use T3G\DatahubApiLibrary\Entity\Order;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;

class OrderApiTest extends AbstractApiTestCase
{
    public function testGetOrder(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOrderResponse.php',
        ]);
        $response = (new OrderApi($this->getClient($handler)))
            ->getOrder('00000000-0000-0000-0000-000000000000');
        self::assertEquals('A12345', $response->getOrderNumber());
        self::assertIsArray($response->getPayload());
        self::assertSame(['items' => [['foo' => 'bar']]], $response->getPayload());
        self::assertCount(1, $response->getInvoices());
        $firstInvoice = $response->getInvoices()[0];
        self::assertSame('https://dienmam.com/invoice', $firstInvoice->getLink());
        self::assertSame((new \DateTimeImmutable('2020-01-10T00:00:00+00:00'))->getTimestamp(), $firstInvoice->getDate()->getTimestamp());
    }

    /**
     * @param string   $fixtureFile
     * @param int|null $limit
     *
     * @throws \JsonException
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     *
     * @dataProvider searchOrdersDataProvider
     */
    public function testSearchOrders(string $fixtureFile, ?int $limit): void
    {
        $handler = new MockHandler([
           require __DIR__ . '/../Fixtures/' . $fixtureFile,
       ]);
        $orderList = (new OrderApi($this->getClient($handler)))
            ->searchOrders(new OrderSearchDemand(), $limit);

        self::assertCount($limit ?? 10, $orderList->getData());
    }

    public static function searchOrdersDataProvider(): \Generator
    {
        yield ['SearchOrdersResponseLimitNull.php', null];
        yield ['SearchOrdersResponseLimit1.php', 1];
        yield ['SearchOrdersResponseLimit5.php', 5];
    }

    public function testCreateOrderForUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOrderResponse.php',
        ]);
        $response = (new OrderApi($this->getClient($handler)))
            ->createOrderForUser('oelie-boelie', $this->getTestOrder());
        self::assertEquals('A12345', $response->getOrderNumber());
        self::assertIsArray($response->getPayload());
        self::assertSame(['items' => [['foo' => 'bar']]], $response->getPayload());
    }

    public function testCreateOrderForCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOrderResponse.php',
        ]);
        $response = (new OrderApi($this->getClient($handler)))
            ->createOrderForCompany('00000000-0000-0000-0000-000000000000', $this->getTestOrder());
        self::assertEquals('A12345', $response->getOrderNumber());
        self::assertIsArray($response->getPayload());
        self::assertSame(['items' => [['foo' => 'bar']]], $response->getPayload());
    }

    public function testUpdateOrder(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOrderResponse.php',
        ]);
        $response = (new OrderApi($this->getClient($handler)))
            ->updateOrder('00000000-0000-0000-0000-000000000000', $this->getTestOrder());
        self::assertEquals('A12345', $response->getOrderNumber());
        self::assertIsArray($response->getPayload());
        self::assertSame(['items' => [['foo' => 'bar']]], $response->getPayload());
    }

    public function testAddInvoice(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOrderResponse.php',
        ]);
        $response = (new OrderApi($this->getClient($handler)))
            ->addInvoice('00000000-0000-0000-0000-000000000000', $this->getTestInvoice());
        $this->assertResponse($response);
        $invoice = $response->getInvoices()[0];
        self::assertSame('invoice', $invoice->getDocumentType());
    }

    public function testAddInvoiceWithoutType(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOrderResponseWithNullDocumentType.php',
        ]);

        $response = (new OrderApi($this->getClient($handler)))
            ->addInvoice('00000000-0000-0000-0000-000000000000', $this->getTestInvoiceWithoutType());
        $this->assertResponse($response);
        $invoice = $response->getInvoices()[0];
        self::assertSame('invoice', $invoice->getDocumentType());
    }

    public function testAddCreditNote(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOrderResponseWithCreditNote.php',
        ]);

        $response = (new OrderApi($this->getClient($handler)))
            ->addInvoice('00000000-0000-0000-0000-000000000000', $this->getTestCreditNote());
        $this->assertResponse($response);
        $invoice = $response->getInvoices()[0];
        self::assertSame('credit_note', $invoice->getDocumentType());
    }

    public function testAddEmptyDocumentType(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOrderResponseWithEmptyDocumentType.php',
        ]);

        $response = (new OrderApi($this->getClient($handler)))
            ->addInvoice('00000000-0000-0000-0000-000000000000', $this->getTestDocumentEmptyType());
        $this->assertResponse($response);
        $invoice = $response->getInvoices()[0];
        self::assertSame('invoice', $invoice->getDocumentType());
    }

    public function testDeleteMailAddressFilter(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php',
        ]);
        $api = new OrderApi($this->getClient($handler));
        try {
            $api->deleteOrder('00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }
        self::assertFalse($anExceptionWasThrown);
    }

    private function getTestOrder(): Order
    {
        return (new Order())
            ->setOrderNumber('A12345')
            ->setPayload([
                'items' => [
                    ['foo' => 'bar'],
                ],
            ]);
    }

    private function getTestInvoice(): Invoice
    {
        return (new Invoice())
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setTitle('Test-Title')
            ->setNumber('I12345')
            ->setIdentifier('in_1234')
            ->setLink('https://dienmam.com/invoice')
            ->setDate(new \DateTimeImmutable('2020-01-10T00:00:00+00:00'))
            ->setDocumentType('invoice')
        ;
    }

    private function getTestInvoiceWithoutType(): Invoice
    {
        return (new Invoice())
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setTitle('Test-Title')
            ->setNumber('I12345')
            ->setIdentifier('in_1234')
            ->setLink('https://dienmam.com/invoice')
            ->setDate(new \DateTimeImmutable('2020-01-10T00:00:00+00:00'))
        ;
    }

    private function getTestDocumentEmptyType(): Invoice
    {
        return (new Invoice())
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setTitle('Test-Title')
            ->setNumber('I12345')
            ->setIdentifier('in_1234')
            ->setLink('https://dienmam.com/invoice')
            ->setDate(new \DateTimeImmutable('2020-01-10T00:00:00+00:00'))
            ->setDocumentType('')
        ;
    }

    /**
     * @param Order $response
     *
     * @return void
     */
    public function assertResponse(Order $response): void
    {
        self::assertEquals('A12345', $response->getOrderNumber());
        self::assertIsArray($response->getPayload());
        self::assertSame(['items' => [['foo' => 'bar']]], $response->getPayload());
        self::assertIsArray($response->getInvoices());
        $invoice = $response->getInvoices()[0];
        self::assertSame('Test-Title', $invoice->getTitle());
        self::assertSame('https://dienmam.com/invoice', $invoice->getLink());
        self::assertSame((new \DateTimeImmutable('2020-01-10T00:00:00+00:00'))->getTimestamp(), $invoice->getDate()->getTimestamp());
        self::assertSame('I12345', $invoice->getNumber());
        self::assertSame('in_1234', $invoice->getIdentifier());
    }

    private function getTestCreditNote(): Invoice
    {
        return (new Invoice())
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setTitle('Test-Title')
            ->setNumber('I12345')
            ->setIdentifier('in_1234')
            ->setLink('https://dienmam.com/invoice')
            ->setDate(new \DateTimeImmutable('2020-01-10T00:00:00+00:00'))
            ->setDocumentType('credit_note')
        ;
    }
}
