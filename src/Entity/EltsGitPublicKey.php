<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class EltsGitPublicKey implements \JsonSerializable
{
    private string $uuid;
    private string $name;
    private string $publicKey;
    private string $eltsVersion;
    private int $githubId = 0;

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'name' => $this->getName(),
            'publicKey' => $this->getPublicKey(),
            'eltsVersion' => $this->getEltsVersion(),
            'githubId' => $this->getGithubId(),
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function setPublicKey(string $publicKey): self
    {
        $this->publicKey = $publicKey;

        return $this;
    }

    public function getEltsVersion(): string
    {
        return $this->eltsVersion;
    }

    public function setEltsVersion(string $eltsVersion): self
    {
        $this->eltsVersion = $eltsVersion;

        return $this;
    }

    /**
     * @internal
     */
    public function getGithubId(): int
    {
        return $this->githubId;
    }

    /**
     * @internal
     */
    public function setGithubId(int $githubId): self
    {
        $this->githubId = $githubId;

        return $this;
    }
}
