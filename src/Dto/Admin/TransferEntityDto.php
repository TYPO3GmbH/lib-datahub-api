<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Dto\Admin;

use Symfony\Component\Validator\Constraints as Assert;
use T3G\DatahubApiLibrary\Dto\AbstractDto;

class TransferEntityDto extends AbstractDto
{
    /**
     * @Assert\NotBlank
     */
    public string $source = '';

    /**
     * @Assert\NotBlank
     */
    public string $target = '';

    /**
     * @Assert\NotBlank
     *
     * @Assert\Choice(callback={"T3G\DatahubApiLibrary\Enum\TransferableType", "getAvailableOptions"})
     */
    public string $type = '';

    /**
     * @Assert\NotBlank
     */
    public string $entityDescriber = '';
}
