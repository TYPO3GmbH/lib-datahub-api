<?php
declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\VoucherCode;

class VoucherCodeFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): VoucherCode
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    public static function fromArray(array $data): VoucherCode
    {
        $code = (new VoucherCode())
            ->setUuid($data['uuid'])
            ->setVoucherCode($data['voucherCode'])
            ->setType($data['type'])
            ->setExpiresAt(new \DateTime($data['expiresAt']))
            ->setStatus($data['status']);

        if (isset($data['user']) && null !== $data['user']) {
            $code->setUser(UserFactory::fromArray($data['user']));
        }
        if (isset($data['company']) && null !== $data['company']) {
            $code->setCompany(CompanyFactory::fromArray($data['company']));
        }

        return $code;
    }
}
