<?php
declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use T3G\DatahubApiLibrary\Entity\VoucherCode;
use T3G\DatahubApiLibrary\Factory\VoucherCodeFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class VoucherCodeApi extends AbstractApi
{
    use HandlesUuids;

    public function getVoucherCode(string $uuid): VoucherCode
    {
        $this->isValidUuidOrThrow($uuid);

        return VoucherCodeFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/voucher-codes/' . $uuid)
            )
        );
    }

    public function updateVoucherCode(string $uuid, VoucherCode $voucherCode): VoucherCode
    {
        $this->isValidUuidOrThrow($uuid);

        return VoucherCodeFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/voucher-codes/' . $uuid),
                json_encode($voucherCode, JSON_THROW_ON_ERROR)
            )
        );
    }

    public function redeemVoucherCode(string $code): VoucherCode
    {
        return VoucherCodeFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/voucher-codes/' . $code . '/redeem')
            )
        );
    }

    public function deleteVoucherCode(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/voucher-codes/' . $uuid)
        );
    }
}
