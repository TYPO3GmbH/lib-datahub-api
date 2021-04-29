<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\EltsPlanExtendableFactory;

class EltsPlanExtendableFactoryTest extends TestCase
{
    public function testFactory(): void
    {
        $entity = EltsPlanExtendableFactory::fromArray([
            'title' => 'Single Plan ELTS 8.7',
            'type' => 'single',
            'version' => '8.7',
            'runtime' => '2-3',
            'validFrom' => '2021-04-01T00:00:00+00:00',
            'validTo' => '2023-03-31T00:00:00+00:00',
        ]);

        self::assertSame('Single Plan ELTS 8.7', $entity->getTitle());
        self::assertSame('single', $entity->getType());
        self::assertSame('8.7', $entity->getVersion());
        self::assertSame('2-3', $entity->getRuntime());
        self::assertEquals(new \DateTimeImmutable('2021-04-01T00:00:00+00:00'), $entity->getValidFrom());
        self::assertEquals(new \DateTimeImmutable('2023-03-31T00:00:00+00:00'), $entity->getValidTo());
    }
}
