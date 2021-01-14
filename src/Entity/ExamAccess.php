<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use JsonSerializable;

class ExamAccess implements JsonSerializable
{
    private string $uuid;

    private string $certificationType;

    private string $certificationVersion;

    private ?string $voucher = null;

    private string $status;

    private ?string $history = null;

    private ?Certification $certification = null;

    public function jsonSerialize()
    {
        return [
            'certificationType' => $this->getCertificationType(),
            'certificationVersion' => $this->getCertificationVersion(),
            'voucher' => $this->getVoucher(),
            'status' => $this->getStatus(),
        ];
    }

    public function getName(): string
    {
        return $this->getCertificationType() . ' v' . $this->getCertificationVersion();
    }

    public function getCertificationType(): string
    {
        return $this->certificationType;
    }

    public function getCertificationVersion(): string
    {
        return $this->certificationVersion;
    }

    public function getVoucher(): ?string
    {
        return $this->voucher;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setCertificationType(string $certificationType): self
    {
        $this->certificationType = $certificationType;
        return $this;
    }

    public function setCertificationVersion($certificationVersion): self
    {
        $this->certificationVersion = $certificationVersion;

        return $this;
    }

    public function setVoucher(?string $voucher): self
    {
        $this->voucher = $voucher;
        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
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

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(?string $history): self
    {
        $this->history = $history;
        return $this;
    }

    public function getCertification(): ?Certification
    {
        return $this->certification;
    }

    public function setCertification(?Certification $certification): self
    {
        $this->certification = $certification;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            '%s v%s Voucher: %s Status: %s',
            $this->certificationType,
            $this->certificationVersion,
            $this->voucher,
            $this->status
        );
    }
}
