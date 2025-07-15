<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Entity\Invoice;
use T3G\DatahubApiLibrary\Factory\InvoiceFactory;

class InvoiceFactoryTest extends TestCase
{
    #[DataProvider('invoiceFactoryDataProvider')]
    public function testFactoryForInvoice(array $data): void
    {
        $entity = InvoiceFactory::fromArray($data);
        $this->internalTestFactory($data, $entity);
        self::assertEquals($data['documentType'], $entity->getDocumentType());
    }

    #[DataProvider('creditNoteDataProvider')]
    public function testFactoryForCreditNote(array $data): void
    {
        $entity = InvoiceFactory::fromArray($data);
        $this->internalTestFactory($data, $entity);
        self::assertEquals($data['documentType'], $entity->getDocumentType());
    }

    #[DataProvider('documentTypeMissingDataProvider')]
    public function testDocumentTypeMissing(array $data): void
    {
        $entity = InvoiceFactory::fromArray($data);
        $this->internalTestFactory($data, $entity);
        self::assertEquals('invoice', $entity->getDocumentType());
    }

    #[DataProvider('emptyDocumentTypeDataProvider')]
    public function testEmptyDocumentType(array $data): void
    {
        $entity = InvoiceFactory::fromArray($data);
        $this->internalTestFactory($data, $entity);
        self::assertEquals('invoice', $entity->getDocumentType());
    }

    public static function emptyDocumentTypeDataProvider(): array
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
                ],
            ],
            'allRequiredValuesSet' => [
                'data' => [
                    'link' => '/account/foo',
                    'date' => '2020-01-10T00:00:00+00:00',
                    'documentType' => '',
                ],
            ],
        ];
    }

    public static function documentTypeMissingDataProvider(): array
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
                ],
            ],
            'allRequiredValuesSet' => [
                'data' => [
                    'link' => '/account/foo',
                    'date' => '2020-01-10T00:00:00+00:00',
                ],
            ],
        ];
    }

    public static function invoiceFactoryDataProvider(): array
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
                ],
            ],
            'allRequiredValuesSet' => [
                'data' => [
                    'link' => '/account/foo',
                    'date' => '2020-01-10T00:00:00+00:00',
                    'documentType' => 'invoice',
                ],
            ],
        ];
    }

    public static function creditNoteDataProvider(): array
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
                ],
            ],
            'allRequiredValuesSet' => [
                'data' => [
                    'link' => '/account/foo',
                    'date' => '2020-01-10T00:00:00+00:00',
                    'documentType' => 'credit_note',
                ],
            ],
        ];
    }

    public function internalTestFactory(array $data, Invoice $entity): void
    {
        self::assertEquals($data['link'], $entity->getLink());
        self::assertEquals((new \DateTime('2020-01-10T00:00:00+00:00'))->getTimestamp(), $entity->getDate()->getTimestamp());
        self::assertEquals($data['uuid'] ?? '', $entity->getUuid());
        self::assertEquals($data['identifier'] ?? '', $entity->getIdentifier());
        self::assertEquals($data['title'] ?? '', $entity->getTitle());
        self::assertEquals($data['number'] ?? '', $entity->getNumber());
    }
}
