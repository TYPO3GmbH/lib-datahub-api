<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\OrderFactory;

class OrderFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     *
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = OrderFactory::fromArray($data);
        self::assertEquals($data['uuid'], $entity->getUuid());
        self::assertEquals($data['orderNumber'], $entity->getOrderNumber());
        self::assertEquals($data['payload'], $entity->getPayload());
        self::assertEquals((new \DateTime('2020-01-10T00:00:00+00:00'))->getTimestamp(), $entity->getCreatedAt()->getTimestamp());
        if (!empty($data['invoices'])) {
            $invoice = $entity->getInvoices()[0];
            self::assertEquals($data['invoices'][0]['uuid'], $invoice->getUuid());
            self::assertEquals($data['invoices'][0]['identifier'], $invoice->getIdentifier());
            self::assertEquals($data['invoices'][0]['documentType'], $invoice->getDocumentType());
            self::assertEquals($data['invoices'][0]['link'], $invoice->getLink());
            self::assertEquals($data['invoices'][0]['title'], $invoice->getTitle());
            self::assertEquals((new \DateTime($data['invoices'][0]['date']))->getTimestamp(), $invoice->getDate()->getTimestamp());

            $creditNote = $entity->getInvoices()[1];
            self::assertEquals($data['invoices'][1]['uuid'], $creditNote->getUuid());
            self::assertEquals($data['invoices'][1]['identifier'], $creditNote->getIdentifier());
            self::assertEquals($data['invoices'][1]['documentType'], $creditNote->getDocumentType());
            self::assertEquals($data['invoices'][1]['link'], $creditNote->getLink());
            self::assertEquals($data['invoices'][1]['title'], $creditNote->getTitle());
            self::assertEquals((new \DateTime($data['invoices'][1]['date']))->getTimestamp(), $creditNote->getDate()->getTimestamp());

            $documentWithOutType = $entity->getInvoices()[2];
            self::assertEquals($data['invoices'][2]['uuid'], $documentWithOutType->getUuid());
            self::assertEquals($data['invoices'][2]['identifier'], $documentWithOutType->getIdentifier());
            self::assertEquals('invoice', $invoice->getDocumentType());
            self::assertEquals($data['invoices'][2]['link'], $documentWithOutType->getLink());
            self::assertEquals($data['invoices'][2]['title'], $documentWithOutType->getTitle());
            self::assertEquals((new \DateTime($data['invoices'][2]['date']))->getTimestamp(), $documentWithOutType->getDate()->getTimestamp());

            $documentWithEmptyType = $entity->getInvoices()[3];
            self::assertEquals($data['invoices'][3]['uuid'], $documentWithEmptyType->getUuid());
            self::assertEquals($data['invoices'][3]['identifier'], $documentWithEmptyType->getIdentifier());
            self::assertEquals('invoice', $invoice->getDocumentType());
            self::assertEquals($data['invoices'][3]['link'], $documentWithEmptyType->getLink());
            self::assertEquals($data['invoices'][3]['title'], $documentWithEmptyType->getTitle());
            self::assertEquals((new \DateTime($data['invoices'][3]['date']))->getTimestamp(), $documentWithEmptyType->getDate()->getTimestamp());
        }
    }

    public static function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'orderNumber' => 'D12345',
                    'createdAt' => '2020-01-10T00:00:00+00:00',
                    'payload' => [
                        'items' => [
                            ['foo' => 'bar'],
                        ],
                    ],
                ],
            ],
            'allValuesSet with invoices' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'orderNumber' => 'D12345',
                    'createdAt' => '2020-01-10T00:00:00+00:00',
                    'payload' => [
                        'items' => [
                            ['foo' => 'bar'],
                        ],
                    ],
                    'invoices' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'identifier' => 'in_1234',
                            'link' => '/account/foo',
                            'title' => 'Test-Invoice',
                            'date' => '2020-01-10T00:00:00+00:00',
                            'documentType' => 'invoice',
                        ],
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000002',
                            'identifier' => 'in_1232',
                            'link' => '/account/foo1',
                            'title' => 'Test-Credit-Note',
                            'date' => '2020-01-10T00:00:00+00:00',
                            'documentType' => 'credit_note',
                        ],
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000003',
                            'identifier' => 'in_1232',
                            'link' => '/account/foo1',
                            'title' => 'Test-Document-No-Type',
                            'date' => '2020-01-10T00:00:00+00:00',
                        ],
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000004',
                            'identifier' => 'in_1232',
                            'link' => '/account/foo1',
                            'title' => 'Empty-Type',
                            'date' => '2020-01-10T00:00:00+00:00',
                            'documentType' => '',
                        ],
                    ],
                ],
            ],
        ];
    }
}
