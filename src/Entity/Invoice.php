<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class Invoice implements \JsonSerializable
{
    private string $uuid = '';
    private \DateTimeInterface $date;
    private string $link;
    private ?string $title = null;
    private string $number = '';
    private string $identifier = '';
    private string $documentType = '';

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'date' => $this->getDate()->format(\DateTimeInterface::ATOM),
            'link' => $this->getLink(),
            'title' => $this->getTitle(),
            'number' => $this->getNumber(),
            'identifier' => $this->getIdentifier(),
            'documentType' => $this->getDocumentType(),
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

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return $this
     */
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return $this
     */
    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return $this
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return $this
     */
    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @return $this
     */
    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getDocumentType(): string
    {
        return $this->documentType;
    }

    /**
     * @return $this
     */
    public function setDocumentType(string $documentType): self
    {
        $this->documentType = $documentType;

        return $this;
    }
}
