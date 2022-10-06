<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\EltsProduct;

/**
 * @extends AbstractFactory<EltsProduct>
 */
class EltsProductFactory extends AbstractFactory
{
    public static function fromArray(array $data): EltsProduct
    {
        $eltsProduct = (new EltsProduct())
            ->setVersion($data['version'])
            ->setVendor($data['vendor'])
            ->setRepository($data['repository'])
            ->setServiceDesk($data['serviceDesk'])
        ;

        foreach ($data['runtimes'] as $runtime) {
            $eltsProduct->addRuntime(EltsProductRuntimeFactory::fromArray($runtime));
        }

        return $eltsProduct;
    }
}
