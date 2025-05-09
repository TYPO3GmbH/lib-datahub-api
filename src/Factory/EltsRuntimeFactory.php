<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\EltsRuntime;

/**
 * @extends AbstractFactory<EltsRuntime>
 */
class EltsRuntimeFactory extends AbstractFactory
{
    public static function fromArray(array $data): EltsRuntime
    {
        $eltsRuntime = (new EltsRuntime())
            ->setUuid($data['uuid'])
            ->setRuntime($data['runtime'])
            ->setPaymentStatus($data['paymentStatus']);

        if (isset($data['validFrom'])) {
            $eltsRuntime->setValidFrom(new \DateTimeImmutable($data['validFrom']));
        }
        if (isset($data['validTo'])) {
            $eltsRuntime->setValidTo(new \DateTimeImmutable($data['validTo']));
        }
        if (isset($data['order']) && is_array($data['order']) && [] !== $data['order']) {
            $eltsRuntime->setOrder(OrderFactory::fromArray($data['order']));
        }

        return $eltsRuntime;
    }
}
