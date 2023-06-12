<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\VoucherCode;

/**
 * @extends AbstractFactory<VoucherCode>
 */
class VoucherCodeFactory extends AbstractFactory
{
    public static function fromArray(array $data): VoucherCode
    {
        $code = (new VoucherCode())
            ->setUuid($data['uuid'])
            ->setTitle($data['title'])
            ->setDescription($data['description'])
            ->setVoucherCode($data['voucherCode'])
            ->setType($data['type'])
            ->setExpiresAt(new \DateTime($data['expiresAt']))
            ->setStatus($data['status'])
            ->setOrderNumber($data['orderNumber'] ?? null)
            ->setProduct($data['product'] ?? null)
            ->setUsername($data['username'] ?? null)
            ->setUsages(array_key_exists('usages', $data) ? $data['usages'] : 1)
            ->setRedemptions($data['redemptions'] ?? 0)
            ->setIsExpired($data['isExpired'] ?? false)
            ->setIsUsed($data['isUsed'] ?? false)
            ->setIsRedeemable($data['isRedeemable'] ?? false)
        ;

        if (isset($data['user'])) {
            $code->setUser(UserFactory::fromArray($data['user']));
        }
        if (isset($data['company'])) {
            $code->setCompany(CompanyFactory::fromArray($data['company']));
        }

        return $code;
    }
}
