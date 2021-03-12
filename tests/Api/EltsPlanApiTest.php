<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\EltsPlanApi;
use T3G\DatahubApiLibrary\Entity\EltsPlan;
use T3G\DatahubApiLibrary\Entity\Order;
use T3G\DatahubApiLibrary\Enum\EltsPlanType;

class EltsPlanApiTest extends AbstractApiTest
{
    public function testCreateEltsPlanForUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEltsPlanResponse.php'
        ]);

        $eltsPlan = $this->getTestEltsPlan();
        $response = (new EltsPlanApi($this->getClient($handler)))
            ->createEltsPlanForUser('oelie-boelie', $eltsPlan);

        self::assertEquals($eltsPlan->getVersion(), $response->getVersion());
        self::assertEquals($eltsPlan->getType(), $response->getType());
        self::assertEquals($eltsPlan->getRuntime(), $response->getRuntime());
        self::assertEquals($eltsPlan->getOrder(), $response->getOrder());
        self::assertCount(1, $response->getInstances());
    }

    public function testCreateEltsPlanForCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEltsPlanResponse.php'
        ]);

        $eltsPlan = $this->getTestEltsPlan();
        $response = (new EltsPlanApi($this->getClient($handler)))
            ->createEltsPlanForCompany('00000000-0000-0000-0000-000000000000', $eltsPlan);

        self::assertEquals($eltsPlan->getVersion(), $response->getVersion());
        self::assertEquals($eltsPlan->getType(), $response->getType());
        self::assertEquals($eltsPlan->getRuntime(), $response->getRuntime());
        self::assertEquals($eltsPlan->getOrder(), $response->getOrder());
        self::assertCount(1, $response->getInstances());
    }

    private function getTestEltsPlan(): EltsPlan
    {
        return (new EltsPlan())
            ->setVersion('8.7')
            ->setType(EltsPlanType::AGENCY)
            ->setRuntime('1-3')
            ->setOrder(
                (new Order())
                ->setUuid('00000000-0000-0000-0000-000000000000')
                ->setOrderNumber('G123456')
                ->setPayload([])
                ->setCreatedAt(new \DateTime('2020-01-10T00:00:00+00:00'))
            );
    }
}
