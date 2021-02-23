<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Demand;

use drupol\phpermutations\Iterators\Product;
use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Demand\OrganizationSearchDemand;

class OrganizationSearchDemandTest extends TestCase
{
    /**
     * This map represents the available with* attributes in OrganizationSearchDemand
     *
     * @var string[]
     */
    private static array $argumentWithMap = [
        'withOrders',
        'withSubscriptions',
        'withVoucherCodes',
        'withElts',
    ];

    public function testWithTerm(): void
    {
        $subject = new OrganizationSearchDemand('Hello');
        self::assertArrayHasKey('term', $subject->toArray());
        self::assertSame('Hello', $subject->toArray()['term']);

        $expectedJson = json_encode(['term' => 'Hello', 'withOrders' => false, 'withSubscriptions' => false, 'withVoucherCodes' => false, 'withElts' => false], JSON_THROW_ON_ERROR);
        self::assertSame($expectedJson, json_encode($subject, JSON_THROW_ON_ERROR));
    }

    /**
     * The order of the attributes *must* be the same as in static::$argumentWithMap
     *
     * @dataProvider withAttributesDataProvider
     * @param bool $withOrders
     * @param bool $withSubscriptions
     * @param bool $withVoucherCodes
     * @param bool $withElts
     */
    public function testWithAttributes(bool $withOrders, bool $withSubscriptions, bool $withVoucherCodes, bool $withElts): void
    {
        $subject = (new OrganizationSearchDemand('Hello'))
            ->setWithOrders($withOrders)
            ->setWithSubscriptions($withSubscriptions)
            ->setWithVoucherCodes($withVoucherCodes)
            ->setWithElts($withElts);

        self::assertSame($withOrders, $subject->isWithOrders());
        self::assertSame($withSubscriptions, $subject->isWithSubscriptions());
        self::assertSame($withVoucherCodes, $subject->isWithVoucherCodes());
        self::assertSame($withElts, $subject->isWithElts());

        $actualArray = $subject->toArray();
        $expectedKeyCount = count(static::$argumentWithMap) + 1; // We have a "term" attribute, hence the +1
        self::assertCount($expectedKeyCount, $actualArray);
        foreach (static::$argumentWithMap as $argumentName) {
            self::assertArrayHasKey($argumentName, $actualArray);
        }

        $argumentCount = func_num_args();
        $arguments = func_get_args();
        self::assertCount(count(static::$argumentWithMap), $arguments);

        for ($i = 0; $i < $argumentCount; ++$i) {
            self::assertArrayHasKey(static::$argumentWithMap[$i], $actualArray);
            self::assertSame($arguments[$i], $actualArray[static::$argumentWithMap[$i]]);
        }
    }

    public function withAttributesDataProvider(): array
    {
        $withAttributeCount = count(static::$argumentWithMap);
        $dataset = array_fill(0, $withAttributeCount, [true, false]);

        $product = (new Product($dataset))->setLength(2 ** $withAttributeCount);
        return $product->toArray();
    }
}
