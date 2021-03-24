<?php
declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\EltsProductRuntime;

class EltsProductRuntimeFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): EltsProductRuntime
    {
        return self::fromArray(self::responseToArray($response));
    }

    public static function fromArray(array $data): EltsProductRuntime
    {
        return (new EltsProductRuntime())
            ->setIdentifier($data['identifier'])
            ->setValidFrom(new \DateTimeImmutable($data['validFrom']))
            ->setValidTo(new \DateTimeImmutable($data['validTo']));
    }
}
