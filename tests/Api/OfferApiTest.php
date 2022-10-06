<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\OfferApi;
use T3G\DatahubApiLibrary\Assembler\CreateOfferAssembler;
use T3G\DatahubApiLibrary\Dto\CreateOfferDto;

class OfferApiTest extends AbstractApiTest
{
    public function testCreateOfferForUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/PostOfferResponse.php',
        ]);
        $offerDto = $this->getOfferDto();
        $response = (new OfferApi($this->getClient($handler)))
            ->createOfferForUser('oelie-boelie', $offerDto);

        self::assertEquals($offerDto->payload, $response->getPayload());
        self::assertEquals($offerDto->offerNumber, $response->getOfferNumber());
        self::assertEquals($offerDto->cartIdentifier, $response->getCartIdentifier());
    }

    public function testCreateOfferForCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/PostOfferResponse.php',
        ]);
        $offerDto = $this->getOfferDto();
        $response = (new OfferApi($this->getClient($handler)))
            ->createOfferForCompany('1174279d-9995-448a-bf79-ba77c797b9a0', $offerDto);

        self::assertEquals($offerDto->payload, $response->getPayload());
        self::assertEquals($offerDto->offerNumber, $response->getOfferNumber());
        self::assertEquals($offerDto->cartIdentifier, $response->getCartIdentifier());
    }

    public function testGetOffersForUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOffersResponse.php',
        ]);
        $response = (new OfferApi($this->getClient($handler)))->getOffersForUser('oelie-boelie');
        self::assertCount(1, $response);

        self::assertSame('dd1183cd-b4d1-402e-a50b-17cc0c72acd9', $response[0]->getUuid());
        self::assertSame('2021-04-12T00:00:00+00:00', $response[0]->getCreatedAt()->format(\DateTimeInterface::ATOM));
        self::assertSame('2021-05-11T00:00:00+00:00', $response[0]->getValidUntil()->format(\DateTimeInterface::ATOM));
        self::assertSame([], $response[0]->getPayload());
        self::assertSame('TO-1234', $response[0]->getOfferNumber());
        self::assertSame('any-identifier', $response[0]->getCartIdentifier());
        self::assertSame(0.0, $response[0]->getTotal());
    }

    public function testGetOffersForCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOffersResponse.php',
        ]);
        $response = (new OfferApi($this->getClient($handler)))->getOffersForCompany('1174279d-9995-448a-bf79-ba77c797b9a0');
        self::assertCount(1, $response);

        self::assertSame('dd1183cd-b4d1-402e-a50b-17cc0c72acd9', $response[0]->getUuid());
        self::assertSame('2021-04-12T00:00:00+00:00', $response[0]->getCreatedAt()->format(\DateTimeInterface::ATOM));
        self::assertSame('2021-05-11T00:00:00+00:00', $response[0]->getValidUntil()->format(\DateTimeInterface::ATOM));
        self::assertSame([], $response[0]->getPayload());
        self::assertSame('TO-1234', $response[0]->getOfferNumber());
        self::assertSame('any-identifier', $response[0]->getCartIdentifier());
        self::assertSame(0.0, $response[0]->getTotal());
    }

    public function testGetOffer(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetOfferResponse.php',
        ]);
        $response = (new OfferApi($this->getClient($handler)))->getOffer('dd1183cd-b4d1-402e-a50b-17cc0c72acd9');
        self::assertSame('dd1183cd-b4d1-402e-a50b-17cc0c72acd9', $response->getUuid());
        self::assertSame('2021-04-12T11:16:12+00:00', $response->getCreatedAt()->format(\DateTimeInterface::ATOM));
        self::assertSame('2021-05-11T23:59:59+00:00', $response->getValidUntil()->format(\DateTimeInterface::ATOM));
        self::assertSame([], $response->getPayload());
        self::assertSame('TO-1234', $response->getOfferNumber());
        self::assertSame('any-identifier', $response->getCartIdentifier());
        self::assertSame(4284.0, $response->getTotal());
    }

    private function getOfferDto(): CreateOfferDto
    {
        $data = [
            'payload' => [],
            'offerNumber' => 'TO-1234',
            'cartIdentifier' => 'any-identifier',
        ];

        return (new CreateOfferAssembler())->create($data)->getDto();
    }
}
