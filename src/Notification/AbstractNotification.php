<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Notification;

use Symfony\Component\Serializer\Annotation\Groups;

abstract class AbstractNotification implements NotificationInterface
{
    /**
     * @Groups({"user"})
     */
    private string $type;

    /**
     * @Groups({"user"})
     */
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
        $this->type = get_class($this);
    }

    public function jsonSerialize()
    {
        return [
            'type' => $this->getType(),
            'message' => $this->getMessage(),
        ];
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
