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
        $this->assertEquals(isset($data['createdAt']) ? new \DateTime($data['createdAt']) : null, $entity->getCreatedAt());
        $this->assertEquals(isset($data['validUntil']) ? new \DateTime($data['validUntil']) : null, $entity->getValidUntil());

        if (isset($date['used'])) {
            $this->assertEquals($data['used'], $entity->getUsed());
        } else {
            $this->assertEquals(false, $entity->getUsed());
        }

        if (isset($data['company'])) {
            $this->assertEquals($data['company']['uuid'], $entity->getCompany()->getUuid());
            $this->assertEquals($data['company']['companyType'], $entity->getCompany()->getCompanyType());
            $this->assertEquals($data['company']['title'], $entity->getCompany()->getTitle());
            $this->assertEquals($data['company']['slug'], $entity->getCompany()->getSlug());
        }
        if (isset($data['user'])) {
            $this->assertEquals($data['user']['username'], $entity->getUser()->getUsername());
            $this->assertEquals($data['user']['firstName'], $entity->getUser()->getFirstName());
            $this->assertEquals($data['user']['lastName'], $entity->getUser()->getLastName());
        }
    }

    public function factoryDataProvider(): array
    {
        return [
            'legacy' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-0000000000000',
                    'voucher' => '',
                    'certificationType' => 'TCCI',
                    'certificationVersion' => '10.4',
                    'status' => 'NEW',
                ]
            ],
            'minimalValuesSet' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-0000000000000',
                    'voucher' => '00000000-0000-0000-0000-0000000000000',
                    'certificationType' => 'TCCI',
                    'certificationVersion' => '10.4',
                    'status' => 'READY',
                    'used' => false,
                ]
            ],
            'allValuesSetCompany' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-0000000000000',
                    'voucher' => '00000000-0000-0000-0000-0000000000000',
                    'company' => [
                        'uuid' => '00000000-0000-0000-0000-000000000000',
                        'companyType' => 'AGENCY',
                        'title' => 'Company A',
                        'slug' => 'company-a'
                    ],
                    'certificationType' => 'TCCI',
                    'certificationVersion' => '9.5',
                    'status' => 'READY',
                    'createdAt' => '2022-03-10T00:00:00+00:00',
                    'validUntil' => '2022-01-10T00:00:00+00:00',
                    'used' => false
                ]
            ],
            'allValuesSetUser' => [
                'data' => [
                    'uuid' => '00000000-0000-0000-0000-0000000000000',
                    'voucher' => '00000000-0000-0000-0000-0000000000000',
                    'user' => [
                        'username' => 'max.muster',
                        'firstName' => 'Max',
                        'lastName' => 'Muster'
                    ],
                    'certificationType' => 'TCCI',
                    'certificationVersion' => '9.5',
                    'status' => 'READY',
                    'createdAt' => '2022-03-10T00:00:00+00:00',
                    'validUntil' => '2022-01-10T00:00:00+00:00',
                    'used' => false
                ]
            ]
        ];
    }
}
