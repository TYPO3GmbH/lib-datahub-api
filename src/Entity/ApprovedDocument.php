<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use DateTimeInterface;
use JsonSerializable;

class ApprovedDocument implements JsonSerializable
{
    private string $documentIdentifier;

    private string $documentVersion;

    private ?DateTimeInterface $approveDate = null;

    private ?User $user = null;

    public function jsonSerialize()
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

    /**
     * @return string
     */
    public function getDocumentIdentifier(): string
    {
        return $this->documentIdentifier;
    }

    /**
     * @param string $documentIdentifier
     * @return ApprovedDocument
     */
    public function setDocumentIdentifier(string $documentIdentifier): self
    {
        $this->documentIdentifier = $documentIdentifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentVersion(): string
    {
        return $this->documentVersion;
    }

    /**
     * @param string $documentVersion
     * @return ApprovedDocument
     */
    public function setDocumentVersion(string $documentVersion): self
    {
        $this->documentVersion = $documentVersion;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getApproveDate(): ?DateTimeInterface
    {
        return $this->approveDate;
    }

    /**
     * @param DateTimeInterface $approveDate
     * @return ApprovedDocument
     */
    public function setApproveDate(?DateTimeInterface $approveDate): self
    {
        $this->approveDate = $approveDate;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return ApprovedDocument
     */
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }
}
