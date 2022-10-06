<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Dto;

class CreateEltsPlanDto extends AbstractDto
{
    public string $version = '';
    public string $type = '';
    public string $runtime = '';
    public string $orderNumber = '';
}
