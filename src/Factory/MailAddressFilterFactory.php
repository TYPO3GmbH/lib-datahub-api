<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\MailAddressFilter;

/**
 * @extends AbstractFactory<MailAddressFilter>
 */
class MailAddressFilterFactory extends AbstractFactory
{
    public static function fromArray(array $data): MailAddressFilter
    {
        return (new MailAddressFilter())
            ->setUuid($data['uuid'])
            ->setPattern($data['pattern'])
            ->setType($data['type']);
    }
}
