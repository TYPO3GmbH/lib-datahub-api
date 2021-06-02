<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\PreCheckResult;

/**
 * @extends AbstractFactory<PreCheckResult>
 */
class PreCheckResultFactory extends AbstractFactory
{
    public static function fromArray(array $data): PreCheckResult
    {
        return (new PreCheckResult())
            ->setSource($data['source'])
            ->setType($data['type'])
            ->setResult($data['result'])
            ->setAdditionalData($data['additionalData']);
    }
}
