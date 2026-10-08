<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Dto;

/**
 * A Stripe price to purchase. Metadata carries scope specific information, e.g. the ELTS runtime, or the usernames
 * of organization members a certification is purchased for (`user_delegates`).
 */
final readonly class CheckoutItemDto implements \JsonSerializable
{
    /**
     * @param non-empty-string     $priceId
     * @param int<1, max>          $quantity
     * @param array<string, mixed> $metadata
     */
    public function __construct(
        public string $priceId,
        public int $quantity = 1,
        public array $metadata = [],
    ) {
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        if (!isset($data['priceId']) || !is_string($data['priceId']) || '' === $data['priceId']) {
            throw new \InvalidArgumentException('Attribute "priceId" is required and must be a non-empty string.', 1791266001);
        }
        if (!isset($data['quantity']) || !is_int($data['quantity']) || 1 > $data['quantity']) {
            throw new \InvalidArgumentException('Attribute "quantity" is required and must be a positive integer.', 1791266002);
        }
        if (isset($data['metadata']) && !is_array($data['metadata'])) {
            throw new \InvalidArgumentException('Attribute "metadata" must be an array.', 1791266003);
        }

        /** @var array<string, mixed> $metadata */
        $metadata = $data['metadata'] ?? [];

        return new self($data['priceId'], $data['quantity'], $metadata);
    }

    /**
     * @return array{priceId: string, quantity: int, metadata: array<string, mixed>}
     */
    public function jsonSerialize(): array
    {
        return [
            'priceId' => $this->priceId,
            'quantity' => $this->quantity,
            'metadata' => $this->metadata,
        ];
    }
}
