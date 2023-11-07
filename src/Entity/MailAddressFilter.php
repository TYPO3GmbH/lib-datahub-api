<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use T3G\DatahubApiLibrary\Enum\MailAddressFilterType;

class MailAddressFilter implements \JsonSerializable
{
    private string $uuid;
    private string $pattern;
    private string $type;

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            'pattern' => $this->getPattern(),
            'type' => $this->getType(),
        ];
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return $this
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @return $this
     */
    public function setPattern(string $pattern): self
    {
        $this->pattern = $pattern;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTypeName(): string
    {
        return MailAddressFilterType::getName($this->getType());
    }
}
