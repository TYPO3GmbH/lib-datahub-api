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
}
