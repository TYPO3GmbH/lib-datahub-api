<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Entity\Certification;
use T3G\DatahubApiLibrary\Factory\CertificationListFactory;

class CertificationListFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $list = CertificationListFactory::fromArray($data);
        foreach ($list as $entity) {
            $this->assertInstanceOf(Certification::class, $entity);
        }
    }

    public function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'entities' => [
                        [
                            'uuid' => '00000000-0000-0000-0000-000000000000',
                            'type' => 'TCCI',
                            'version' => '10.4',
                            'auditType' => 'PRESENCE',
                            'status' => 'PASSED',
                            'examLocation' => 'Aldi',
                            'examDate' => null,
                            'proctoringLink' => null,
                            'examUrl' => 'https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000',
                        ],
                        [
                            'uuid' => '11111111-1111-1111-1111-111111111111',
                            'type' => 'TCCE',
                            'version' => '10.4',
                            'auditType' => 'PRESENCE',
                            'status' => 'FAILED',
                            'examLocation' => 'online',
                            'examDate' => null,
                            'proctoringLink' => null,
                            'examUrl' => 'https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000',
                        ],
                    ],
                    'length' => 2,
                    'type' => 'App\\Entity\\CertificationList'
                ],
            ],
        ];
    }
}
