<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class ExamAccess implements \JsonSerializable
{
    private string $uuid;
    private ?User $user = null;
    private ?Company $company = null;
    private string $certificationType;
    private string $certificationVersion;
    private ?string $voucher = null;
    private ?string $status = null;
    private ?string $history = null;
    private ?\DateTimeInterface $createdAt = null;
    private ?\DateTimeInterface $validUntil = null;
    private ?bool $used = null;

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'certificationType' => $this->getCertificationType(),
            'certificationVersion' => $this->getCertificationVersion(),
            'voucher' => $this->getVoucher(),
            'createdAt' => null !== $this->getCreatedAt() ? $this->getCreatedAt()->format(\DateTimeInterface::ATOM) : null,
            'validUntil' => null !== $this->getValidUntil() ? $this->getValidUntil()->format(\DateTimeInterface::ATOM) : null,
            'used' => $this->getUsed(),
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * @return $this
     */
    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getCertificationType(): string
    {
        return $this->certificationType;
    }

    /**
     * @return $this
     */
    public function setCertificationType(string $certificationType): self
    {
        $this->certificationType = $certificationType;

        return $this;
    }

    public function getCertificationVersion(): string
    {
        return $this->certificationVersion;
    }

    /**
     * @return $this
     */
    public function setCertificationVersion(string $certificationVersion): self
    {
        $this->certificationVersion = $certificationVersion;

        return $this;
    }

    public function getVoucher(): ?string
    {
        return $this->voucher;
    }

    /**
     * @return $this
     */
    public function setVoucher(string $voucher): self
    {
        $this->voucher = $voucher;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return $this
     */
    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    /**
     * @return $this
     */
    public function setHistory(?string $history): self
    {
        $this->history = $history;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return $this
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getValidUntil(): ?\DateTimeInterface
    {
        return $this->validUntil;
    }

    /**
     * @return $this
     */
    public function setValidUntil(?\DateTimeInterface $validUntil): self
    {
        $this->validUntil = $validUntil;

        return $this;
    }

    public function getUsed(): ?bool
    {
        return $this->used;
    }

    /**
     * @return $this
     */
    public function setUsed(?bool $used): self
    {
        $this->used = $used;

        return $this;
    }

    public function getName(): string
    {
        return $this->getCertificationType() . ' v' . $this->getCertificationVersion();
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
