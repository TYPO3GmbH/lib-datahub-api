<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

class SystemMessageView
{
    private int $id;
    private SystemMessage $systemMessage;
    private ?\DateTimeImmutable $viewDate = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getSystemMessage(): SystemMessage
    {
        return $this->systemMessage;
    }

    public function setSystemMessage(SystemMessage $systemMessage): self
    {
        $this->systemMessage = $systemMessage;

        return $this;
    }

    public function getViewDate(): ?\DateTimeImmutable
    {
        return $this->viewDate;
    }

    public function setViewDate(?\DateTimeImmutable $viewDate): self
    {
        $this->viewDate = $viewDate;

        return $this;
    }
}
