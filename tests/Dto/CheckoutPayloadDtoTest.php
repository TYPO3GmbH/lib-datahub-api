<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Dto;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Dto\CheckoutPayloadDto;

class CheckoutPayloadDtoTest extends TestCase
{
    public function testRoundTrip(): void
    {
        $data = [
            'items' => [['priceId' => 'price_1', 'quantity' => 2, 'metadata' => ['user_delegates' => ['jane', 'john']]]],
            'addressUuid' => 'address-uuid',
            'referenceNumber' => 'PO-42',
            'payByInvoice' => true,
        ];

        self::assertSame($data, CheckoutPayloadDto::fromArray($data)->toArray());
    }

    public function testDefaults(): void
    {
        $payload = CheckoutPayloadDto::fromArray(['items' => [['priceId' => 'price_1', 'quantity' => 1]], 'addressUuid' => '']);

        self::assertSame([], $payload->items[0]->metadata);
        self::assertNull($payload->addressUuid);
        self::assertNull($payload->referenceNumber);
        self::assertFalse($payload->payByInvoice);
        self::assertSame('address-uuid', $payload->withAddressUuid('address-uuid')->addressUuid);
    }

    public static function invalidPayloadDataProvider(): \Iterator
    {
        yield 'missing items' => [[]];
        yield 'empty items' => [['items' => []]];
        yield 'item is no array' => [['items' => ['price_1']]];
        yield 'missing price' => [['items' => [['quantity' => 1]]]];
        yield 'zero quantity' => [['items' => [['priceId' => 'price_1', 'quantity' => 0]]]];
        yield 'quantity as string' => [['items' => [['priceId' => 'price_1', 'quantity' => '1']]]];
        yield 'metadata is no array' => [['items' => [['priceId' => 'price_1', 'quantity' => 1, 'metadata' => 'foo']]]];
        yield 'address is no string' => [['items' => [['priceId' => 'price_1', 'quantity' => 1]], 'addressUuid' => 1]];
        yield 'pay by invoice is no boolean' => [['items' => [['priceId' => 'price_1', 'quantity' => 1]], 'payByInvoice' => 'yes']];
    }

    /**
     * @param array<mixed> $data
     */
    #[DataProvider('invalidPayloadDataProvider')]
    public function testInvalidPayloadIsRejected(array $data): void
    {
        $this->expectException(\InvalidArgumentException::class);

        CheckoutPayloadDto::fromArray($data);
    }
}
