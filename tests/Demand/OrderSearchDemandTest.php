<?php declare(strict_types=1);

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

        static::assertNull($orderSearchDemand->getCompanyUuid());
        static::assertNull($orderSearchDemand->getDateFrom());
        static::assertNull($orderSearchDemand->getDateUntil());
        static::assertNull($orderSearchDemand->getSearchTerm());
        static::assertSame(json_encode($orderSearchDemand, JSON_FORCE_OBJECT), '{}');
    }

    public function testWithUserId(): void
    {
        $orderSearchDemand = (new OrderSearchDemand())->withCompanyUuid('7bf7be08-bdb1-4823-ad24-b45d45a520a6');

        static::assertSame('7bf7be08-bdb1-4823-ad24-b45d45a520a6', $orderSearchDemand->getCompanyUuid());
        static::assertNull($orderSearchDemand->getDateFrom());
        static::assertNull($orderSearchDemand->getDateUntil());
        static::assertNull($orderSearchDemand->getSearchTerm());
        static::assertSame(json_encode($orderSearchDemand, JSON_FORCE_OBJECT), '{"companyUuid":"7bf7be08-bdb1-4823-ad24-b45d45a520a6"}');
    }

    public function testWithDateFrom(): void
    {
        $orderSearchDemand = (new OrderSearchDemand())->withDateFrom(new \DateTime('@187485'));

        static::assertNull($orderSearchDemand->getCompanyUuid());
        static::assertInstanceOf(\DateTime::class, $orderSearchDemand->getDateFrom());
        static::assertNull($orderSearchDemand->getDateUntil());
        static::assertNull($orderSearchDemand->getSearchTerm());
        static::assertSame(json_encode($orderSearchDemand, JSON_FORCE_OBJECT), '{"dateFrom":"1970-01-03T04:04:45.000+00:00"}');
    }

    public function testWithDateUntil(): void
    {
        $orderSearchDemand = (new OrderSearchDemand())->withDateUntil(new \DateTime('@1557795489'));

        static::assertNull($orderSearchDemand->getCompanyUuid());
        static::assertNull($orderSearchDemand->getDateFrom());
        static::assertInstanceOf(\DateTime::class, $orderSearchDemand->getDateUntil());
        static::assertNull($orderSearchDemand->getSearchTerm());
        static::assertSame(json_encode($orderSearchDemand, JSON_FORCE_OBJECT), '{"dateUntil":"2019-05-14T00:58:09.000+00:00"}');
    }

    public function testWithSearchTerm(): void
    {
        $orderSearchDemand = (new OrderSearchDemand())->withSearchTerm('foo');

        static::assertNull($orderSearchDemand->getCompanyUuid());
        static::assertNull($orderSearchDemand->getDateFrom());
        static::assertNull($orderSearchDemand->getDateUntil());
        static::assertSame('foo', $orderSearchDemand->getSearchTerm());
        static::assertSame(json_encode($orderSearchDemand, JSON_FORCE_OBJECT), '{"searchTerm":"foo"}');
    }
}
