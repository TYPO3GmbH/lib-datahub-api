<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\Offer;

/**
 * @extends AbstractFactory<Offer>
 */
class OfferFactory extends AbstractFactory
{
    public static function fromArray(array $data): Offer
    {
        $company = isset($data['company']) ? CompanyFactory::fromArray($data['company']) : null;
        $user = isset($data['user']) ? UserFactory::fromArray($data['user']) : null;

        return (new Offer())
            ->setUuid($data['uuid'])
            ->setCreatedAt(new \DateTimeImmutable($data['createdAt']))
            ->setValidUntil(new \DateTimeImmutable($data['validUntil']))
            ->setPayload($data['payload'])
            ->setOfferNumber($data['offerNumber'])
            ->setCartIdentifier($data['cartIdentifier'])
            ->setTotal($data['total'])
            ->setUser($user)
            ->setCompany($company);
    }
}
