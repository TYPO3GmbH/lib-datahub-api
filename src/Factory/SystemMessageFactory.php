<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\SystemMessage;

/**
 * @extends AbstractFactory<SystemMessage>
 */
class SystemMessageFactory extends AbstractFactory
{
    /**
     * @param array{uuid: string, title?: ?string, message?: ?string, createdAt?: ?string, active?: ?bool} $data
     */
    public static function fromArray(array $data): SystemMessage
    {
        return (new SystemMessage())
            ->setUuid($data['uuid'])
            ->setTitle($data['title'] ?? null)
            ->setMessage($data['message'] ?? null)
            ->setCreatedAt(isset($data['createdAt']) ? new \DateTimeImmutable($data['createdAt']) : null)
            ->setActive($data['active'] ?? null);
    }
}
