<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\Link;

/**
 * @extends AbstractFactory<Link>
 */
class LinkFactory extends AbstractFactory
{
    /**
     * @param array{uuid: string, type: string, value: string, highlight: bool} $data
     */
    public static function fromArray(array $data): Link
    {
        return (new Link())
            ->setUuid($data['uuid'])
            ->setType($data['type'])
            ->setValue($data['value'])
            ->setHighlight($data['highlight']);
    }
}
