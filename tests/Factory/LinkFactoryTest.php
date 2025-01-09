<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\LinkFactory;

class LinkFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     *
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = LinkFactory::fromArray($data);
        self::assertEquals($data['uuid'], $entity->getUuid());
        self::assertEquals($data['type'], $entity->getType());
        self::assertEquals($data['value'], $entity->getValue());
        self::assertEquals($data['highlight'], $entity->isHighlight());
    }

    public static function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'type' => 'github',
                    'value' => 'oelie-boelie',
                    'highlight' => true,
                ],
            ],
        ];
    }
}
