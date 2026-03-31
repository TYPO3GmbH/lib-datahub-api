<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class EltsMaintainedVersion
{
    private string $version;
    private \DateTimeImmutable $from;
    private \DateTimeImmutable $to;
    private bool $isPartnerExclusive;

    /**
     * @var array{from: \DateTimeInterface|null, to: \DateTimeInterface|null}
     */
    private array $ltsSupport;

    /** @var array{to: \DateTimeInterface|null} */
    private array $eltsSupport;

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): EltsMaintainedVersion
    {
        $this->version = $version;

        return $this;
    }

    public function getFrom(): \DateTimeImmutable
    {
        return $this->from;
    }

    public function setFrom(\DateTimeImmutable $from): EltsMaintainedVersion
    {
        $this->from = $from;

        return $this;
    }

    public function getTo(): \DateTimeImmutable
    {
        return $this->to;
    }

    public function setTo(\DateTimeImmutable $to): EltsMaintainedVersion
    {
        $this->to = $to;

        return $this;
    }

    public function isPartnerExclusive(): bool
    {
        return $this->isPartnerExclusive;
    }

    public function setIsPartnerExclusive(bool $isPartnerExclusive): EltsMaintainedVersion
    {
        $this->isPartnerExclusive = $isPartnerExclusive;

        return $this;
    }

    /**
     * @return array{from: \DateTimeInterface|null, to: \DateTimeInterface|null}
     */
    public function getLtsSupport(): array
    {
        return $this->ltsSupport;
    }

    /**
     * @param array{from: \DateTimeInterface|null, to: \DateTimeInterface|null} $ltsSupport
     */
    public function setLtsSupport(array $ltsSupport): EltsMaintainedVersion
    {
        $this->ltsSupport = $ltsSupport;

        return $this;
    }

    /**
     * @return array{to: \DateTimeInterface|null}
     */
    public function getEltsSupport(): array
    {
        return $this->eltsSupport;
    }

    /**
     * @param array{to: \DateTimeInterface|null} $eltsSupport
     */
    public function setEltsSupport(array $eltsSupport): EltsMaintainedVersion
    {
        $this->eltsSupport = $eltsSupport;

        return $this;
    }
}
