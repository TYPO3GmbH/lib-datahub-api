<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\SystemMessageView;

/**
 * @extends AbstractFactory<SystemMessageView>
 */
class SystemMessageViewFactory extends AbstractFactory
{
    /**
     * @param array{id: int, systemMessage: array{uuid: string}, viewDate?: ?string} $data
     */
    public static function fromArray(array $data): SystemMessageView
    {
        return (new SystemMessageView())
            ->setId($data['id'])
            ->setSystemMessage(SystemMessageFactory::fromArray($data['systemMessage']))
            ->setViewDate(isset($data['viewDate']) ? new \DateTimeImmutable($data['viewDate']) : null);
    }
}
