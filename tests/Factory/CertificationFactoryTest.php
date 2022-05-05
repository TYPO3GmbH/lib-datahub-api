<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\CertificationFactory;

class CertificationFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = CertificationFactory::fromArray($data);
        $this->assertEquals($data['type'], $entity->getType());
        $this->assertEquals($data['status'], $entity->getStatus());
        $this->assertEquals($data['examLocation'], $entity->getExamLocation());
        $this->assertEquals($data['hubspotDealId'] ?? null, $entity->getHubspotDealId());
        if (null !== $data['examDate']) {
            $this->assertEquals($data['examDate'], $entity->getExamDate()->format(\DateTimeInterface::ATOM));
        }
        if (null !== $data['proctoringLink']) {
            $this->assertEquals($data['proctoringLink'], $entity->getProctoringLink());
        }
        $this->assertEquals($data['examUrl'], $entity->getExamUrl());
    }

    public function factoryDataProvider(): array
    {
        return [
            'minimalValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'type' => 'TCCI',
                    'version' => '10.4',
                    'auditType' => 'PRESENCE',
                    'status' => 'PASSED',
                    'examLocation' => 'Aldi',
                    'examDate' => null,
                    'proctoringLink' => null,
                    'examUrl' => 'https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000',
                ]
            ],
            'allValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-000000000000',
                    'type' => 'TCCI',
                    'version' => '10.4',
                    'auditType' => 'PRESENCE',
                    'status' => 'PASSED',
                    'examLocation' => 'Aldi',
                    'hubspotDealId' => '1234',
                    'examDate' => '2020-02-26T00:00:00+00:00',
                    'proctoringLink' => 'https://example.com/00000000-0000-0000-0000-000000000000',
                    'examUrl' => 'https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000',
                ]
            ]
        ];
    }
}
