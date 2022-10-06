<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\Content;

/**
 * @extends AbstractFactory<Content>
 */
class ContentFactory extends AbstractFactory
{
    public static function fromArray(array $data): Content
    {
        return (new Content())
            ->setContent($data['content'])
            ->setFormat($data['format'])
            ->setIdentifier($data['identifier'])
            ->setVersion($data['version']);
    }
}
