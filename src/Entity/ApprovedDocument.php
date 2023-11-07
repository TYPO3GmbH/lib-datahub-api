<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class ApprovedDocument implements \JsonSerializable
{
    private string $documentIdentifier;
    private string $documentVersion;
    private ?\DateTimeInterface $approveDate = null;
    private ?User $user = null;

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = [
            'documentIdentifier' => $this->documentIdentifier,
            'documentVersion' => $this->documentVersion,
        ];
        if (null !== $this->approveDate) {
            $data['approveDate'] = $this->approveDate->format(\DateTimeInterface::ATOM);
        }
        if (null !== $this->user) {
            $data['user'] = $this->user;
        }

        return $data;
    }

    public function getDocumentIdentifier(): string
    {
        return $this->documentIdentifier;
    }

    public function setDocumentIdentifier(string $documentIdentifier): static
    {
        $this->documentIdentifier = $documentIdentifier;

        return $this;
    }

    public function getDocumentVersion(): string
    {
        return $this->documentVersion;
    }

    public function setDocumentVersion(string $documentVersion): static
    {
        $this->documentVersion = $documentVersion;

        return $this;
    }

    public function getApproveDate(): ?\DateTimeInterface
    {
        return $this->approveDate;
    }

    public function setApproveDate(?\DateTimeInterface $approveDate): static
    {
        $this->approveDate = $approveDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
