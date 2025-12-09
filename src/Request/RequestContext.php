<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Request;

final readonly class RequestContext
{
    public function __construct(
        public string $type,
        public string $identifier,
    ) {
    }

    public static function fromCombinedIdentifier(string $combinedIdentifier): self
    {
        [$type, $identifier] = explode(':', $combinedIdentifier, 2);

        return new self($type, $identifier);
    }

    public function toArray(): array
    {
        return [
            'context' => [
                'type' => $this->type,
                'identifier' => $this->identifier,
            ],
        ];
    }
}
