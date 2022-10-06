<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Notification;

interface NotificationInterface extends \JsonSerializable
{
    public function getMessage(): string;

    public function setMessage(string $message): self;

    public function getType(): string;

    public function setType(string $type): self;
}
