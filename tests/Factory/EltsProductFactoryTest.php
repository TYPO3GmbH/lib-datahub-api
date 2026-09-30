<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\EltsProductFactory;

class EltsProductFactoryTest extends TestCase
{
    public function testFactory(): void
    {
        $entity = EltsProductFactory::fromArray([
            'version' => '12.4',
            'vendor' => 'TYPO3GmbH',
            'repository' => 'elts-12.4-release',
            'serviceDesk' => 'https://support.typo3.com',
            'runtimes' => [],
        ]);

        self::assertSame('12.4', $entity->getVersion());
        self::assertSame('TYPO3GmbH', $entity->getVendor());
        self::assertSame('elts-12.4-release', $entity->getRepository());
        self::assertSame('https://support.typo3.com', $entity->getServiceDesk());
    }

    public function testVendorAndRepositoryMayBeNull(): void
    {
        $entity = EltsProductFactory::fromArray([
            'version' => '13.4',
            'vendor' => null,
            'repository' => null,
            'serviceDesk' => 'https://support.typo3.com',
            'runtimes' => [],
        ]);

        self::assertNull($entity->getVendor());
        self::assertNull($entity->getRepository());
    }
}
