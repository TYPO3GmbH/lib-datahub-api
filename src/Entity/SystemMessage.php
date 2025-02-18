<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class SystemMessage implements \JsonSerializable
{
    private string $uuid;
    private ?string $title = null;
    private ?string $message = null;
    private ?\DateTimeImmutable $createdAt = null;
    private ?bool $active = null;

    /**
     * @return array<string, string|bool|null>
     */
    public function jsonSerialize(): array
    {
        return [
            'title' => $this->getTitle(),
            'message' => $this->getMessage(),
            'active' => $this->isActive(),
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): SystemMessage
    {
        $this->title = $title;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): SystemMessage
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): SystemMessage
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): SystemMessage
    {
        $this->active = $active;

        return $this;
    }

}
