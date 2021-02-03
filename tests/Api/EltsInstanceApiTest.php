<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\EltsInstanceApi;
use T3G\DatahubApiLibrary\Entity\EltsInstance;
use T3G\DatahubApiLibrary\Entity\User;

class EltsInstanceApiTest extends AbstractApiTest
{
    public function testCreateInstanceForPlan(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEltsInstanceResponse.php'
        ]);

        $eltsIntance = $this->getTestEltsInstanceForGet();
        $response = (new EltsInstanceApi($this->getClient($handler)))
            ->createInstanceForPlan('00000000-0000-0000-0000-000000000000', $eltsIntance);

        self::assertEquals($eltsIntance->getUuid(), $response->getUuid());
        self::assertEquals($eltsIntance->getName(), $response->getName());
        self::assertCount(2, $response->getTechnicalContacts());
    }

    public function testGetInstance(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEltsInstanceResponse.php'
        ]);

        $eltsInstance = $this->getTestEltsInstanceForGet();
        $response = (new EltsInstanceApi($this->getClient($handler)))
            ->getInstance('c5c729b5-e5c3-42f3-89ce-caa07e670fc2');

        self::assertEquals($eltsInstance->getUuid(), $response->getUuid());
        self::assertEquals($eltsInstance->getName(), $response->getName());
        self::assertCount(2, $response->getTechnicalContacts());
    }

    public function testUpdateInstance(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/PutEltsInstanceResponse.php'
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
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
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
            ->setUuid('c5c729b5-e5c3-42f3-89ce-caa07e670fc2')
            ->setName('Wololo, Inc.')
            ->setTechnicalContacts([
                (new User())->setUsername('foobar'),
                (new User())->setUsername('bazbencer'),
            ]);
    }

    private function getTestEltsInstanceForPut(): EltsInstance
    {
        return (new EltsInstance())
            ->setName('Wololo Ltd.')
            ->setTechnicalContacts([
                (new User())->setUsername('bazbencer'),
            ]);
    }
}
