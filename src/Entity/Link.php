<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use T3G\DatahubApiLibrary\Enum\LinkTypes;

class Link implements \JsonSerializable
{
    private string $uuid;
    private string $value;
    private string $type;
    private bool $highlight;

    /**
     * @return array<string, string|bool>
     */
    public function jsonSerialize(): array
    {
        return [
            'value' => $this->getValue(),
            'type' => $this->getType(),
            'highlight' => $this->isHighlight(),
        ];
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function isHighlight(): bool
    {
        return $this->highlight;
    }

    public function setHighlight(bool $highlight): self
    {
        $this->highlight = $highlight;

        return $this;
    }

    public function getUrl(): ?string
    {
        return LinkTypes::getUrlPrefix($this->type ?? '') . $this->value;
    }
}
