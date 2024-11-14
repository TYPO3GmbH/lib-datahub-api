<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\EltsMaintainedVersion;
use T3G\DatahubApiLibrary\Entity\EltsMaintainedVersionList;

/**
 * @extends AbstractFactory<EltsMaintainedVersion>
 */
class EltsMaintainedVersionFactory extends AbstractFactory
{
    /**
     * @param ResponseInterface $response
     *
     * @return EltsMaintainedVersionList
     */
    public static function fromResponseDataCollection(ResponseInterface $response): EltsMaintainedVersionList
    {
        /** @var array<int, array{version: string, from: string, to: string}> $arrayResponse */
        $arrayResponse = self::responseToArray($response);
        $data = array_map(
            static fn (array $eltsInstanceData) => self::fromArray($eltsInstanceData),
            $arrayResponse
        );

        return new EltsMaintainedVersionList($data);
    }

    /**
     * @param array{version: string, from: string, to: string} $data
     *
     * @return EltsMaintainedVersion
     */
    public static function fromArray(array $data): EltsMaintainedVersion
    {
        return (new EltsMaintainedVersion())
            ->setVersion($data['version'])
            ->setFrom(new \DateTimeImmutable($data['from']))
            ->setTo(new \DateTimeImmutable($data['to']));
    }
}
