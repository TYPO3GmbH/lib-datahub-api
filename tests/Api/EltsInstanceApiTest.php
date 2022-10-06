<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\EltsInstanceApi;
use T3G\DatahubApiLibrary\Entity\EltsInstance;
use T3G\DatahubApiLibrary\Entity\TechnicalContact;

class EltsInstanceApiTest extends AbstractApiTest
{
    public function testCreateInstanceForPlan(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEltsInstanceResponse.php',
        ]);

        $eltsIntance = $this->getTestEltsInstanceForGet();
        $response = (new EltsInstanceApi($this->getClient($handler)))
            ->createInstanceForPlan('00000000-0000-0000-0000-000000000000', $eltsIntance);

        self::assertEquals($eltsIntance->getUuid(), $response->getUuid());
        self::assertEquals($eltsIntance->getName(), $response->getName());
        self::assertCount(1, $response->getTechnicalContacts());
    }

    public function testGetInstance(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEltsInstanceResponse.php',
        ]);

        $eltsInstance = $this->getTestEltsInstanceForGet();
        $response = (new EltsInstanceApi($this->getClient($handler)))
            ->getInstance('c5c729b5-e5c3-42f3-89ce-caa07e670fc2');

        self::assertEquals($eltsInstance->getUuid(), $response->getUuid());
        self::assertEquals($eltsInstance->getName(), $response->getName());
        self::assertCount(1, $response->getTechnicalContacts());
    }

    public function testGetInstances(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEltsInstancesResponse.php',
        ]);

        $response = (new EltsInstanceApi($this->getClient($handler)))->getInstances();

        $instances = $response->getData();
        self::assertCount(1, $instances);
        self::assertEquals('11111111-1111-1111-1111-111111111111', $instances[0]->getUuid());
        self::assertEquals('Agency instance 1', $instances[0]->getName());
        self::assertCount(4, $instances[0]->getTechnicalContacts());
    }

    public function testUpdateInstance(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/PutEltsInstanceResponse.php',
        ]);

        $eltsInstance = $this->getTestEltsInstanceForPut();
        $response = (new EltsInstanceApi($this->getClient($handler)))
            ->updateInstance('c5c729b5-e5c3-42f3-89ce-caa07e670fc2', $this->getTestEltsInstanceForPut());

        self::assertEquals('c5c729b5-e5c3-42f3-89ce-caa07e670fc2', $response->getUuid());
        self::assertEquals($eltsInstance->getName(), $response->getName());
        self::assertCount(1, $response->getTechnicalContacts());
    }

    public function testDeleteInstance(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php',
        ]);
        $api = new EltsInstanceApi($this->getClient($handler));
        try {
            $api->deleteInstance('c5c729b5-e5c3-42f3-89ce-caa07e670fc2');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }

        self::assertFalse($anExceptionWasThrown);
    }

    private function getTestEltsInstanceForGet(): EltsInstance
    {
        return (new EltsInstance())
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setName('Single instance')
            ->setTechnicalContacts([
                (new TechnicalContact())->setUser('foobar'),
                (new TechnicalContact())->setUser('bazbencer'),
            ]);
    }

    private function getTestEltsInstanceForPut(): EltsInstance
    {
        return (new EltsInstance())
            ->setName('Wololo Ltd.')
            ->setTechnicalContacts([
                (new TechnicalContact())->setUser('bazbencer'),
            ]);
    }
}
