<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\EltsPlanApi;
use T3G\DatahubApiLibrary\Dto\CreateEltsPlanDto;
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

        self::assertEquals($eltsPlan->version, $response->getVersion());
        self::assertEquals($eltsPlan->type, $response->getType());
        self::assertEquals($eltsPlan->runtime, $response->getRuntime());
        self::assertEquals($eltsPlan->orderNumber, $response->getOrder()->getOrderNumber());
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

        self::assertEquals($eltsPlan->version, $response->getVersion());
        self::assertEquals($eltsPlan->type, $response->getType());
        self::assertEquals($eltsPlan->runtime, $response->getRuntime());
        self::assertEquals($eltsPlan->orderNumber, $response->getOrder()->getOrderNumber());
        self::assertCount(1, $response->getInstances());
    }

    private function getTestEltsPlan(): CreateEltsPlanDto
    {
        $createEltsPlanDto = new CreateEltsPlanDto();
        $createEltsPlanDto->version = '8.7';
        $createEltsPlanDto->type = EltsPlanType::AGENCY;
        $createEltsPlanDto->runtime = '1-3';
        $createEltsPlanDto->orderNumber = 'G123456';
        return $createEltsPlanDto;
    }
}
