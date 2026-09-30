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
            // Both are null if the version has no GitHub repository
            ->setVendor(is_string($data['vendor'] ?? null) ? $data['vendor'] : null)
            ->setRepository(is_string($data['repository'] ?? null) ? $data['repository'] : null)
            ->setServiceDesk($data['serviceDesk'])
        ;

        foreach ($data['runtimes'] as $runtime) {
            $eltsProduct->addRuntime(EltsProductRuntimeFactory::fromArray($runtime));
        }

        return $eltsProduct;
    }
}
