<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class EmailAddress implements \JsonSerializable
{
    private string $uuid;
    private string $email;
    private int $type;
    private ?\DateTimeInterface $optIn = null;

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [
            'email' => $this->getEmail(),
            'type' => $this->getType(),
        ];
        if (null !== $this->optIn) {
            $data['optIn'] = $this->optIn->format(\DateTimeInterface::ATOM);
        }

        return $data;
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getOptIn(): ?\DateTimeInterface
    {
        return $this->optIn;
    }

    public function setOptIn(?\DateTimeInterface $optIn): self
    {
        $this->optIn = $optIn;

        return $this;
    }
}
