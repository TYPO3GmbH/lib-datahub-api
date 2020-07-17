<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\ExamAccessFactory;

class ExamAccessFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = ExamAccessFactory::fromArray($data);
        $this->assertEquals($data['certificationType'], $entity->getCertificationType());
        $this->assertEquals($data['certificationVersion'], $entity->getCertificationVersion());
        $this->assertEquals($data['status'], $entity->getStatus());
        $this->assertEquals($data['voucher'], $entity->getVoucher());
        $this->assertEquals($data['uuid'], $entity->getUuid());
    }

    public function factoryDataProvider(): array
    {
        return [
            'minimalValuesSet' => [
                'data' => [
                    'certificationType' => 'TCCI',
                    'certificationVersion' => '10.4',
                    'status' => 'NEW',
                    'voucher' => '',
                    'uuid' => '00000000-0000-0000-0000-0000000000000',
                ]
            ],
            'allValuesSet' => [
                'data' => [
                    'certificationType' => 'TCCI',
                    'certificationVersion' => '9.5',
                    'status' => 'READY',
                    'voucher' => '00000000-0000-0000-0000-0000000000001',
                    'uuid' => '00000000-0000-0000-0000-0000000000000',
                ]
            ]
        ];
    }
}
