<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class ReservedUser
{
    private string $uuid;
    private string $username;
    private string $email;
    private \DateTimeInterface $deleteDate;
    private string $otrsIssue;
    private string $comment;
    private string $status;

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

    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDeleteDate(): \DateTimeInterface
    {
        return $this->deleteDate;
    }

    /**
     * @return $this
     */
    public function setDeleteDate(\DateTimeInterface $deleteDate): self
    {
        $this->deleteDate = $deleteDate;

        return $this;
    }

    public function getOtrsIssue(): string
    {
        return $this->otrsIssue;
    }

    /**
     * @return $this
     */
    public function setOtrsIssue(string $otrsIssue): self
    {
        $this->otrsIssue = $otrsIssue;

        return $this;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @return $this
     */
    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
