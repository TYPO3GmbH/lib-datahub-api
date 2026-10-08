<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Dto;

/**
 * The cart of a checkout. All items belong to the same checkout scope, see CheckoutScope.
 */
final readonly class CheckoutPayloadDto implements \JsonSerializable
{
    /**
     * @param list<CheckoutItemDto> $items
     */
    public function __construct(
        public array $items,
        public ?string $addressUuid = null,
        public ?string $referenceNumber = null,
        public bool $payByInvoice = false,
    ) {
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        if (!isset($data['items']) || !is_array($data['items']) || [] === $data['items']) {
            throw new \InvalidArgumentException('Attribute "items" is required and must be a non-empty array.', 1791266011);
        }
        if (isset($data['addressUuid']) && !is_string($data['addressUuid'])) {
            throw new \InvalidArgumentException('Attribute "addressUuid" must be a string.', 1791266012);
        }
        if (isset($data['referenceNumber']) && !is_string($data['referenceNumber'])) {
            throw new \InvalidArgumentException('Attribute "referenceNumber" must be a string.', 1791266013);
        }
        if (isset($data['payByInvoice']) && !is_bool($data['payByInvoice'])) {
            throw new \InvalidArgumentException('Attribute "payByInvoice" must be a boolean.', 1791266014);
        }

        $items = [];
        foreach ($data['items'] as $item) {
            if (!is_array($item)) {
                throw new \InvalidArgumentException('Attribute "items" must only contain arrays.', 1791266015);
            }
            $items[] = CheckoutItemDto::fromArray($item);
        }

        $addressUuid = $data['addressUuid'] ?? null;

        return new self(
            $items,
            is_string($addressUuid) && '' !== $addressUuid ? $addressUuid : null,
            $data['referenceNumber'] ?? null,
            $data['payByInvoice'] ?? false,
        );
    }

    public function withAddressUuid(?string $addressUuid): self
    {
        return new self($this->items, $addressUuid, $this->referenceNumber, $this->payByInvoice);
    }

    /**
     * @return array{items: list<array{priceId: string, quantity: int, metadata: array<string, mixed>}>, addressUuid: string|null, referenceNumber: string|null, payByInvoice: bool}
     */
    public function toArray(): array
    {
        return [
            'items' => array_map(static fn (CheckoutItemDto $item) => $item->jsonSerialize(), $this->items),
            'addressUuid' => $this->addressUuid,
            'referenceNumber' => $this->referenceNumber,
            'payByInvoice' => $this->payByInvoice,
        ];
    }

    /**
     * @return array{items: list<array{priceId: string, quantity: int, metadata: array<string, mixed>}>, addressUuid: string|null, referenceNumber: string|null, payByInvoice: bool}
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
