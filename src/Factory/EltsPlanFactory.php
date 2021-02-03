<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\EltsPlan;

class EltsPlanFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): EltsPlan
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    /**
     * @param array<string, mixed> $data
     * @return EltsPlan
     */
    public static function fromArray(array $data): EltsPlan
    {
        $eltsPlan = (new EltsPlan())
            ->setUuid($data['uuid'])
            ->setType($data['type'])
            ->setRuntime($data['runtime'])
            ->setVersion($data['version']);

        foreach ($data['instances'] ?? [] as $instance) {
            $eltsPlan->addInstance(EltsInstanceFactory::fromArray($instance));
        }

        return $eltsPlan;
    }
}
