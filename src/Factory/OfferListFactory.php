<?php
declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\Offer;
use T3G\DatahubApiLibrary\Entity\OfferList;

/**
 * @extends AbstractFactory<Offer>
 */
class OfferListFactory extends AbstractFactory
{
    public static function fromResponseDataCollection(ResponseInterface $response): OfferList
    {
        $arrayResponse = self::responseToArray($response);
        $data = array_map(
            static fn (array $offerData) => self::fromArray($offerData),
            $arrayResponse['entities']
        );
        return new OfferList($data);
    }

    public static function fromArray(array $data): Offer
    {
        return OfferFactory::fromArray($data);
    }
}
