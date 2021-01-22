<?php
declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\VoucherCodeApi;
use T3G\DatahubApiLibrary\Entity\VoucherCode;
use T3G\DatahubApiLibrary\Enum\VoucherCodeStatus;
use T3G\DatahubApiLibrary\Enum\VoucherCodeType;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;

class VoucherCodeApiTest extends AbstractApiTest
{
    public function testGetVoucherCode(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetVoucherCodeResponse.php'
        ]);
        $api = new VoucherCodeApi($this->getClient($handler));
        $response = $api->getVoucherCode('00000000-0000-0000-0000-000000000000');
        self::assertEquals('Event Voucher', $response->getTitle());
        self::assertEquals('200 EUR discount for one event ticket', $response->getDescription());
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getVoucherCode());
        self::assertEquals('max.muster', $response->getUser()->getUsername());
    }

    public function testUpdateVoucherCode(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetVoucherCodeResponse.php'
        ]);
        $api = new VoucherCodeApi($this->getClient($handler));
        $response = $api->updateVoucherCode('00000000-0000-0000-0000-000000000000', $this->getTestVoucherCode());
        self::assertEquals('Event Voucher', $response->getTitle());
        self::assertEquals('200 EUR discount for one event ticket', $response->getDescription());
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getVoucherCode());
        self::assertEquals('max.muster', $response->getUser()->getUsername());
    }

    public function testRedeemVoucherCode(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetVoucherCodeResponse.php'
        ]);
        $api = new VoucherCodeApi($this->getClient($handler));
        $response = $api->redeemVoucherCode('00000000-0000-0000-0000-000000000000');
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertEquals('00000000-0000-0000-0000-000000000000', $response->getVoucherCode());
        self::assertEquals('max.muster', $response->getUser()->getUsername());
    }

    public function testDeleteVoucherCode(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
        ]);
        $api = new VoucherCodeApi($this->getClient($handler));
        $api->deleteVoucherCode('00000000-0000-0000-0000-000000000000');
        $this->expectException(InvalidUuidException::class);
        $api->deleteVoucherCode('lidl');
    }

    private function getTestVoucherCode(): VoucherCode
    {
        return (new VoucherCode())
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setStatus(VoucherCodeStatus::NEW)
            ->setTitle('Event Voucher')
            ->setDescription('200 EUR discount for one event ticket')
            ->setType(VoucherCodeType::EVENTS)
            ->setExpiresAt(new \DateTime());
    }
}
