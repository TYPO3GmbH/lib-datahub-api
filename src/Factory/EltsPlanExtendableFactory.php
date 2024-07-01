<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\EltsPlanExtendable;

/**
 * @extends AbstractFactory<EltsPlanExtendable>
 */
class EltsPlanExtendableFactory extends AbstractFactory
{
    /**
     * @param array{title: string, version: string, type: string, runtime: string, validFrom: \DateTimeImmutable, validTo: \DateTimeImmutable, isPartnerExclusive: bool} $data
     *
     * @return EltsPlanExtendable
     */
    public static function fromArray(array $data): EltsPlanExtendable
    {
        return (new EltsPlanExtendable())
            ->setTitle($data['title'])
            ->setVersion($data['version'])
            ->setType($data['type'])
            ->setRuntime($data['runtime'])
            ->setValidFrom(new \DateTimeImmutable($data['validFrom']))
            ->setValidTo(new \DateTimeImmutable($data['validTo']))
            ->setIsPartnerExclusive($data['isPartnerExclusive']);
    }
}
