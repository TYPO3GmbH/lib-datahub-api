<?php
declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\EltsProduct;
use T3G\DatahubApiLibrary\Entity\EltsProductList;

/**
 * @extends AbstractFactory<EltsProduct>
 */
class EltsProductListFactory extends AbstractFactory
{
    /**
     * @param ResponseInterface $response
     * @return EltsProductList
     */
    public static function fromResponseDataCollection(ResponseInterface $response): EltsProductList
    {
        $arrayResponse = self::responseToArray($response);
        $data = array_map(
            static fn (array $eltsInstanceData) => self::fromArray($eltsInstanceData),
            $arrayResponse
        );
        return new EltsProductList($data);
    }

    public static function fromArray(array $data): EltsProduct
    {
        return EltsProductFactory::fromArray($data);
    }
}
