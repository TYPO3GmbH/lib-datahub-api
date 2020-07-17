<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Factory;

use DateTime;
use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\ApprovedDocumentFactory;

class ApprovedDocumentFactoryTest extends TestCase
{
    /**
     * @dataProvider factoryDataProvider
     * @param array $data
     */
    public function testFactory(array $data): void
    {
        $entity = ApprovedDocumentFactory::fromArray($data);
        $this->assertEquals($data['documentIdentifier'], $entity->getDocumentIdentifier());
        $this->assertEquals($data['documentVersion'], $entity->getDocumentVersion());
        $this->assertEquals($data['approveDate'], $entity->getApproveDate()->format(DateTime::ATOM));
        $this->assertEquals($data['user']['username'], $entity->getUser()->getUsername());
    }

    public function factoryDataProvider(): array
    {
        return [
            'allValuesSet' => [
                'data' => [
                    'documentIdentifier' => 'foo',
                    'documentVersion' => '1.0.0',
                    'approveDate' => '2020-02-26T00:00:00+00:00',
                    'user' => [
                        'username' => 'oelie-boelie',
                        'firstName' => 'Oelie',
                        'lastName' => 'Boelie',
                        'email' => 'oelie@boelie.nl',
                        'phone' => null
                    ],
                ]
            ]
        ];
    }
}
