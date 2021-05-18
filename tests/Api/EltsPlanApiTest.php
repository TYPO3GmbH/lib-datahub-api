<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use T3G\DatahubApiLibrary\Api\EltsPlanApi;
use T3G\DatahubApiLibrary\Assembler\UpdatePaymentStatusAssembler;
use T3G\DatahubApiLibrary\Dto\CreateEltsPlanDto;
use T3G\DatahubApiLibrary\Dto\ProlongEltsPlanDto;
use T3G\DatahubApiLibrary\Enum\EltsPlanType;
use T3G\DatahubApiLibrary\Enum\PaymentStatus;

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
        self::assertCount(1, $response->getRuntimes());
        self::assertSame($response->getRuntimes()[0]->getRuntime(), $eltsPlan->runtime);
        self::assertSame($response->getRuntimes()[0]->getOrder()->getOrderNumber(), $eltsPlan->orderNumber);
        self::assertCount(0, $response->getExtendables());
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
        self::assertCount(1, $response->getRuntimes());
        self::assertSame($response->getRuntimes()[0]->getRuntime(), $eltsPlan->runtime);
        self::assertSame($response->getRuntimes()[0]->getOrder()->getOrderNumber(), $eltsPlan->orderNumber);
        self::assertCount(0, $response->getExtendables());
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
        self::assertSame('8.7', $plans[0]->getVersion());
        self::assertSame('agency', $plans[0]->getType());
        self::assertSame('Agency Plan 8.7 ELTS', $plans[0]->getTitle());
        self::assertSame('2-2', $plans[0]->getRuntime());
        self::assertEquals(new \DateTimeImmutable('2021-04-01T00:00:00+00:00'), $plans[0]->getValidFrom());
        self::assertEquals(new \DateTimeImmutable('2022-03-31T00:00:00+00:00'), $plans[0]->getValidTo());
        self::assertCount(1, $plans[0]->getRuntimes());
        self::assertSame($plans[0]->getRuntimes()[0]->getRuntime(), $plans[0]->getRuntime());
        self::assertSame($plans[0]->getRuntimes()[0]->getOrder()->getOrderNumber(), $plans[0]->getOrder()->getOrderNumber());
        self::assertEquals(new \DateTimeImmutable('2021-04-01T00:00:00+00:00'), $plans[0]->getRuntimes()[0]->getValidFrom());
        self::assertEquals(new \DateTimeImmutable('2022-03-31T00:00:00+00:00'), $plans[0]->getRuntimes()[0]->getValidTo());
        self::assertCount(1, $plans[0]->getExtendables());
        self::assertArrayHasKey('3-3', $plans[0]->getExtendables());
        self::assertCount(2, $plans[0]->getInstances());
        self::assertEquals(null, $plans[0]->getLicenses());
        self::assertEquals('GELTS234', $plans[0]->getOrder()->getOrderNumber());
        self::assertCount(2, $plans[0]->getReleaseNotifications());
        self::assertCount(2, $plans[0]->getTechnicalContacts());

        self::assertSame('8.7', $plans[1]->getVersion());
        self::assertSame('pro', $plans[1]->getType());
        self::assertSame('Pro Plan 8.7 ELTS', $plans[1]->getTitle());
        self::assertSame('2-3', $plans[1]->getRuntime());
        self::assertEquals(new \DateTimeImmutable('2021-04-01T00:00:00+00:00'), $plans[1]->getValidFrom());
        self::assertEquals(new \DateTimeImmutable('2023-03-31T00:00:00+00:00'), $plans[1]->getValidTo());
        self::assertCount(1, $plans[1]->getRuntimes());
        self::assertSame($plans[1]->getRuntimes()[0]->getRuntime(), $plans[1]->getRuntime());
        self::assertNull($plans[1]->getRuntimes()[0]->getOrder());
        self::assertEquals(new \DateTimeImmutable('2021-04-01T00:00:00+00:00'), $plans[1]->getRuntimes()[0]->getValidFrom());
        self::assertEquals(new \DateTimeImmutable('2023-03-31T00:00:00+00:00'), $plans[1]->getRuntimes()[0]->getValidTo());
        self::assertCount(0, $plans[1]->getExtendables());
        self::assertCount(0, $plans[1]->getInstances());
        self::assertSame(5, $plans[1]->getLicenses());
        self::assertNull($plans[1]->getOrder());
        self::assertCount(0, $plans[1]->getReleaseNotifications());
        self::assertCount(0, $plans[1]->getTechnicalContacts());
    }

    public function testGetEltsPlansExport(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEltsPlansExportResponse.php'
        ]);

        $response = (new EltsPlanApi($this->getClient($handler)))->getPlans();

        $plans = $response->getData();
        self::assertCount(5, $plans);
        self::assertSame('8.7', $plans[0]->getVersion());
        self::assertSame('single', $plans[0]->getType());
        self::assertSame('Single Plan', $plans[0]->getTitle());
        self::assertSame('', $plans[0]->getRuntime());
        self::assertCount(2, $plans[0]->getRuntimes());
        self::assertSame($plans[0]->getRuntimes()[0]->getRuntime(), '1-1');
        self::assertSame($plans[0]->getRuntimes()[0]->getOrder()->getOrderNumber(), 'GELTS123');
        self::assertCount(0, $plans[0]->getReleaseNotifications());
        self::assertCount(0, $plans[0]->getTechnicalContacts());

        self::assertSame('8.7', $plans[1]->getVersion());
        self::assertSame('agency', $plans[1]->getType());
        self::assertSame('Agency Plan', $plans[1]->getTitle());
        self::assertSame('', $plans[1]->getRuntime());
        self::assertCount(1, $plans[1]->getRuntimes());
        self::assertSame($plans[1]->getRuntimes()[0]->getRuntime(), '2-2');
        self::assertNotNull($plans[1]->getRuntimes()[0]->getOrder());
        self::assertCount(0, $plans[1]->getInstances());
        self::assertNull($plans[1]->getOrder());
        self::assertCount(0, $plans[1]->getReleaseNotifications());
        self::assertCount(0, $plans[1]->getTechnicalContacts());
    }

    public function testGetEltsProducts(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEltsProductsResponse.php'
        ]);
        $eltsProducts = (new EltsPlanApi($this->getClient($handler)))->getProducts();

        self::assertCount(1, $eltsProducts);

        $firstPlan = $eltsProducts[0];
        self::assertSame('8.7', $firstPlan->getVersion());
        self::assertSame('TYPO3GmbH', $firstPlan->getVendor());
        self::assertSame('elts-8.7-release', $firstPlan->getRepository());
        self::assertSame('https://jira.typo3.com/servicedesk/customer/portal/12', $firstPlan->getServiceDesk());
        self::assertCount(6, $firstPlan->getRuntimes());
    }

    private function getTestEltsPlan(): CreateEltsPlanDto
    {
        $createEltsPlanDto = new CreateEltsPlanDto();
        $createEltsPlanDto->version = '8.7';
        $createEltsPlanDto->type = EltsPlanType::SINGLE;
        $createEltsPlanDto->runtime = '1-3';
        $createEltsPlanDto->orderNumber = 'GELTS123';
        return $createEltsPlanDto;
    }

    public function testDeletePlan(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
        ]);
        $api = new EltsPlanApi($this->getClient($handler));
        try {
            $api->deletePlan('c5c729b5-e5c3-42f3-89ce-caa07e670fc2');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }

        self::assertFalse($anExceptionWasThrown);
    }

    public function testProlongPlan(): void
    {
        $dto = new ProlongEltsPlanDto();
        $dto->sourcePlan = '00000000-0000-0000-0000-000000000000';
        $dto->runtime = '2-2';

        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/PostEltsProlongResponse.php'
        ]);
        $response = (new EltsPlanApi($this->getClient($handler)))->prolongPlan($dto);

        self::assertSame('11111111-1111-1111-1111-111111111111', $response->getUuid());
        self::assertEquals('8.7', $response->getVersion());
        self::assertEquals('single', $response->getType());
        self::assertSame('2-2', $response->getRuntime());
    }

    public function testUpdateRuntimePaymentStatus(): void
    {
        $dto = (new UpdatePaymentStatusAssembler())->create([
            'orderNumber' => 'O12345',
            'paymentStatus' => PaymentStatus::PAID,
        ])->getDto();

        $container = [];
        $mockHandler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $handlerStack->push(Middleware::history($container));

        (new EltsPlanApi($this->getClient($handlerStack)))->updateRuntimePaymentStatus($dto);

        self::assertCount(1, $container);

        /** @var Request $request */
        $request = reset($container)['request'];
        self::assertSame($dto->toArray(), json_decode((string)$request->getBody(), true, 512, JSON_THROW_ON_ERROR));
    }
}
