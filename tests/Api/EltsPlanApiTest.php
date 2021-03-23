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

    public function testGetEltsPlans(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEltsPlansResponse.php'
        ]);

        $response = (new EltsPlanApi($this->getClient($handler)))->getPlans();

        $plans = $response->getData();
        self::assertCount(2, $plans);
        self::assertEquals('8.7', $plans[0]->getVersion());
        self::assertEquals('agency', $plans[0]->getType());
        self::assertEquals('Agency Plan 8.7 ELTS', $plans[0]->getTitle());
        self::assertEquals('2-2', $plans[0]->getRuntime());
        self::assertEquals(new \DateTimeImmutable('2021-04-01T00:00:00+00:00'), $plans[0]->getValidFrom());
        self::assertEquals(new \DateTimeImmutable('2022-03-31T00:00:00+00:00'), $plans[0]->getValidTo());
        self::assertCount(2, $plans[0]->getInstances());
        self::assertEquals(null, $plans[0]->getLicenses());
        self::assertEquals('GELTS234', $plans[0]->getOrder()->getOrderNumber());
        self::assertCount(2, $plans[0]->getReleaseNotifications());
        self::assertCount(2, $plans[0]->getTechnicalContacts());

        self::assertEquals('8.7', $plans[1]->getVersion());
        self::assertEquals('pro', $plans[1]->getType());
        self::assertEquals('Pro Plan 8.7 ELTS', $plans[1]->getTitle());
        self::assertEquals('2-3', $plans[1]->getRuntime());
        self::assertEquals(new \DateTimeImmutable('2021-04-01T00:00:00+00:00'), $plans[1]->getValidFrom());
        self::assertEquals(new \DateTimeImmutable('2023-03-31T00:00:00+00:00'), $plans[1]->getValidTo());
        self::assertCount(0, $plans[1]->getInstances());
        self::assertSame(5, $plans[1]->getLicenses());
        self::assertEquals(null, $plans[1]->getOrder());
        self::assertCount(0, $plans[1]->getReleaseNotifications());
        self::assertCount(0, $plans[1]->getTechnicalContacts());
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
