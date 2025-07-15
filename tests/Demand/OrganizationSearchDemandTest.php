<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Demand;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Demand\OrganizationSearchDemand;
use T3G\DatahubApiLibrary\Enum\SubscriptionType;

class OrganizationSearchDemandTest extends TestCase
{
    public function testWithLiteral(): void
    {
        $subject = new OrganizationSearchDemand();
        $subject->setTerm('Hello')->setSubscriptionTypes([SubscriptionType::MEMBERSHIP]);
        self::assertArrayHasKey('term', $subject->toArray());
        self::assertSame('Hello', $subject->toArray()['term']);

        $expectedJson = json_encode([
            'term' => 'Hello',
            'withOrders' => false,
            'subscriptionTypes' => [SubscriptionType::MEMBERSHIP],
            'withVoucherCodes' => false,
            'withElts' => false,
        ], JSON_THROW_ON_ERROR);
        self::assertSame($expectedJson, json_encode($subject, JSON_THROW_ON_ERROR));
    }

    public function testNullValuesAreIgnoredFromSerialization(): void
    {
        $subject = new OrganizationSearchDemand();
        $subject->setTerm('Hello');
        $subject->setWithVoucherCodes();
        self::assertArrayHasKey('term', $subject->toArray());
        self::assertSame('Hello', $subject->toArray()['term']);

        $expectedJson = json_encode([
            'term' => 'Hello',
            'withOrders' => false,
            'withVoucherCodes' => true,
            'withElts' => false,
        ], JSON_THROW_ON_ERROR);
        self::assertSame($expectedJson, json_encode($subject, JSON_THROW_ON_ERROR));
    }

    public function testWithSubscriptionsSetsValueAsExpected(): void
    {
        $demand = new OrganizationSearchDemand();
        $demand->setSubscriptionTypes([SubscriptionType::MEMBERSHIP, SubscriptionType::PSL]);

        self::assertSame([SubscriptionType::MEMBERSHIP, SubscriptionType::PSL], $demand->getSubscriptionTypes());
    }

    #[DataProvider('setMembersRangeAsExpectedDataProvider')]
    public function testSetMembersRangeAsExpected(array $input, ?array $expectation): void
    {
        $demand = new OrganizationSearchDemand();
        $demand->setMembersRange($input);

        self::assertSame($expectation, $demand->getMembersRange());
    }

    public static function setMembersRangeAsExpectedDataProvider(): array
    {
        return [
            'given min value' => [[2, null], [2, null]],
            'given max value' => [[null, 10], [null, 10]],
            'given min and max value' => [[10, 20], [10, 20]],
        ];
    }

    #[DataProvider('setMembersRangeThrowsExceptionDataProvider')]
    public function testSetMembersRangeThrowsException(array $input, string $expectedExceptionClass, int $expectedExceptionCode): void
    {
        $this->expectException($expectedExceptionClass);
        $this->expectExceptionCode($expectedExceptionCode);

        $demand = new OrganizationSearchDemand();
        $demand->setMembersRange($input);
    }

    public static function setMembersRangeThrowsExceptionDataProvider(): array
    {
        return [
            'missing range values' => [[], \InvalidArgumentException::class, 1668413261],
            'missing second range value' => [[0], \InvalidArgumentException::class, 1668413261],
            'negative min value' => [[-100, 100], \InvalidArgumentException::class, 1668411601],
            'negative max value' => [[0, -42], \InvalidArgumentException::class, 1668411604],
            'min higher than max' => [[40, 12], \LogicException::class, 1668411780],
            'invalid data type string' => [[''], \TypeError::class, 1668413253],
            'invalid data type object' => [[new \stdClass()], \TypeError::class, 1668413253],
            'invalid data type array' => [[[]], \TypeError::class, 1668413253],
            'invalid data type callable' => [[static function () {}], \TypeError::class, 1668413253],
        ];
    }
}
