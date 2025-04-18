<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Demand;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Demand\OrderSearchDemand;

class OrderSearchDemandTest extends TestCase
{
    public function testConstructor(): void
    {
        $orderSearchDemand = new OrderSearchDemand();

        self::assertNull($orderSearchDemand->getCompanyUuid());
        self::assertNull($orderSearchDemand->getDateFrom());
        self::assertNull($orderSearchDemand->getDateUntil());
        self::assertNull($orderSearchDemand->getSearchTerm());
        self::assertSame(json_encode($orderSearchDemand, JSON_THROW_ON_ERROR | JSON_FORCE_OBJECT), '{"dateField":"createdAt"}');
    }

    public function testWithUserId(): void
    {
        $orderSearchDemand = (new OrderSearchDemand())->withCompanyUuid('7bf7be08-bdb1-4823-ad24-b45d45a520a6');

        self::assertSame('7bf7be08-bdb1-4823-ad24-b45d45a520a6', $orderSearchDemand->getCompanyUuid());
        self::assertNull($orderSearchDemand->getDateFrom());
        self::assertNull($orderSearchDemand->getDateUntil());
        self::assertNull($orderSearchDemand->getSearchTerm());
        self::assertSame(json_encode($orderSearchDemand, JSON_THROW_ON_ERROR | JSON_FORCE_OBJECT), '{"companyUuid":"7bf7be08-bdb1-4823-ad24-b45d45a520a6","dateField":"createdAt"}');
    }

    public function testWithDateFrom(): void
    {
        $orderSearchDemand = (new OrderSearchDemand())->withDateFrom(new \DateTime('@187485'));

        self::assertNull($orderSearchDemand->getCompanyUuid());
        self::assertInstanceOf(\DateTime::class, $orderSearchDemand->getDateFrom());
        self::assertNull($orderSearchDemand->getDateUntil());
        self::assertNull($orderSearchDemand->getSearchTerm());
        self::assertSame(json_encode($orderSearchDemand, JSON_THROW_ON_ERROR | JSON_FORCE_OBJECT), '{"dateFrom":"1970-01-03T04:04:45.000+00:00","dateField":"createdAt"}');
    }

    public function testWithDateUntil(): void
    {
        $orderSearchDemand = (new OrderSearchDemand())->withDateUntil(new \DateTime('@1557795489'));

        self::assertNull($orderSearchDemand->getCompanyUuid());
        self::assertNull($orderSearchDemand->getDateFrom());
        self::assertInstanceOf(\DateTime::class, $orderSearchDemand->getDateUntil());
        self::assertNull($orderSearchDemand->getSearchTerm());
        self::assertSame(json_encode($orderSearchDemand, JSON_THROW_ON_ERROR | JSON_FORCE_OBJECT), '{"dateUntil":"2019-05-14T00:58:09.000+00:00","dateField":"createdAt"}');
    }

    public function testWithSearchTerm(): void
    {
        $orderSearchDemand = (new OrderSearchDemand())->withSearchTerm('foo');

        self::assertNull($orderSearchDemand->getCompanyUuid());
        self::assertNull($orderSearchDemand->getDateFrom());
        self::assertNull($orderSearchDemand->getDateUntil());
        self::assertSame('foo', $orderSearchDemand->getSearchTerm());
        self::assertSame(json_encode($orderSearchDemand, JSON_THROW_ON_ERROR | JSON_FORCE_OBJECT), '{"searchTerm":"foo","dateField":"createdAt"}');
    }

    public function testWithDateField(): void
    {
        $orderSearchDemand = (new OrderSearchDemand())->withDateField(OrderSearchDemand::DATE_FIELD_LAST_INVOICE_DATE);

        self::assertNull($orderSearchDemand->getCompanyUuid());
        self::assertNull($orderSearchDemand->getDateFrom());
        self::assertNull($orderSearchDemand->getDateUntil());
        self::assertSame(OrderSearchDemand::DATE_FIELD_LAST_INVOICE_DATE, $orderSearchDemand->getDateField());
        self::assertSame(json_encode($orderSearchDemand, JSON_THROW_ON_ERROR | JSON_FORCE_OBJECT), '{"dateField":"lastInvoiceDate"}');
    }

    public function testUnknownDateFieldThrows(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        (new OrderSearchDemand())->withDateField('thisIsNotAField');
    }
}
