<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Entity\Invoice;
use T3G\DatahubApiLibrary\Factory\InvoiceFactory;

class InvoiceFactoryTest extends TestCase
{
    /**
     * @dataProvider invoiceFactoryDataProvider
     * @param array $data
     */
    public function testFactoryForInvoice(array $data): void
    {
        $entity = InvoiceFactory::fromArray($data);
        $this->internalTestFactory($data, $entity);
        $this->assertEquals($data['documentType'], $entity->getDocumentType());
    }

    /**
     * @dataProvider creditNoteDataProvider
     * @param array $data
     */
    public function testFactoryForCreditNote(array $data): void
    {
        $entity = InvoiceFactory::fromArray($data);
        $this->internalTestFactory($data, $entity);
        $this->assertEquals($data['documentType'], $entity->getDocumentType());
    }

    /**
     * @dataProvider documentTypeMissingDataProvider
     * @param array $data
     */
    public function testDocumentTypeMissing(array $data): void
    {
        $entity = InvoiceFactory::fromArray($data);
        $this->internalTestFactory($data, $entity);
        $this->assertEquals('invoice', $entity->getDocumentType());
    }

    /**
     * @dataProvider emptyDocumentTypeDataProvider
     * @param array $data
     */
    public function testEmptyDocumentType(array $data): void
    {
        $entity = InvoiceFactory::fromArray($data);
        $this->internalTestFactory($data, $entity);
        $this->assertEquals('invoice', $entity->getDocumentType());
    }

    public function emptyDocumentTypeDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'identifier' => 'in_1234',
                    'link' => '/account/foo',
                    'title' => 'Test-Invoice',
                    'number' => 'I123456',
                    'date' => '2020-01-10T00:00:00+00:00',
                    'documentType' => '',
                ]
            ],
            'allRequiredValuesSet' => [
                'data' => [
                    'link' => '/account/foo',
                    'date' => '2020-01-10T00:00:00+00:00',
                    'documentType' => '',
                ]
            ]
        ];
    }

    public function documentTypeMissingDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'identifier' => 'in_1234',
                    'link' => '/account/foo',
                    'title' => 'Test-Invoice',
                    'number' => 'I123456',
                    'date' => '2020-01-10T00:00:00+00:00',
                ]
            ],
            'allRequiredValuesSet' => [
                'data' => [
                    'link' => '/account/foo',
                    'date' => '2020-01-10T00:00:00+00:00'
                ]
            ]
        ];
    }

    public function invoiceFactoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'identifier' => 'in_1234',
                    'link' => '/account/foo',
                    'title' => 'Test-Invoice',
                    'number' => 'I123456',
                    'date' => '2020-01-10T00:00:00+00:00',
                    'documentType' => 'invoice',
                ]
            ],
            'allRequiredValuesSet' => [
                'data' => [
                    'link' => '/account/foo',
                    'date' => '2020-01-10T00:00:00+00:00',
                    'documentType' => 'invoice',
                ]
            ]
        ];
    }

    public function creditNoteDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-00000000000',
                    'identifier' => 'in_1234',
                    'link' => '/account/foo',
                    'title' => 'Test-Credit-Note',
                    'number' => 'I123456',
                    'date' => '2020-01-10T00:00:00+00:00',
                    'documentType' => 'credit_note',
                ]
            ],
            'allRequiredValuesSet' => [
                'data' => [
                    'link' => '/account/foo',
                    'date' => '2020-01-10T00:00:00+00:00',
                    'documentType' => 'credit_note',
                ]
            ]
        ];
    }

    /**
     * @param array $data
     * @return void
     */
    public function internalTestFactory(array $data, Invoice $entity): void
    {
        $this->assertEquals($data['link'], $entity->getLink());
        $this->assertEquals((new \DateTime('2020-01-10T00:00:00+00:00'))->getTimestamp(), $entity->getDate()->getTimestamp());
        $this->assertEquals($data['uuid'] ?? '', $entity->getUuid());
        $this->assertEquals($data['identifier'] ?? '', $entity->getIdentifier());
        $this->assertEquals($data['title'] ?? '', $entity->getTitle());
        $this->assertEquals($data['number'] ?? '', $entity->getNumber());
    }
}
