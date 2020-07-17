<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use DateTime;
use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\MembershipFactory;

class MembershipFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = MembershipFactory::fromArray($data);
        $this->assertEquals($data['type'], $entity->getType());
        $this->assertEquals($data['validUntil'], $entity->getValidUntil()->format(DateTime::ATOM));
    }

    public function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'type' => 'COMMUNITY',
                    'validUntil' => '2020-02-26T00:00:00+00:00'
                ]
            ]
        ];
    }
}
