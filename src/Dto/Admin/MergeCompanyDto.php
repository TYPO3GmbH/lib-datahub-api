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

class MergeCompanyDto extends AbstractDto
{
    /**
     * This property contains the UUID of the entity
     * that value should be used.
     *
     * @Assert\NotBlank
     *
     * @Assert\Uuid
     */
    #[Assert\NotBlank]
    #[Assert\Uuid]
    public string $title = '';

    /**
     * This property contains the UUID of the entity
     * that value should be used.
     *
     * @Assert\NotBlank
     *
     * @Assert\Uuid
     */
    #[Assert\NotBlank]
    #[Assert\Uuid]
    public string $slug = '';

    /**
     * This property contains the UUID of the entity
     * that value should be used.
     *
     * @Assert\NotBlank
     *
     * @Assert\Uuid
     */
    #[Assert\NotBlank]
    #[Assert\Uuid]
    public string $companyType = '';

    /**
     * This property contains the UUID of the entity
     * that value should be used.
     *
     * @Assert\NotBlank
     *
     * @Assert\Uuid
     */
    #[Assert\NotBlank]
    #[Assert\Uuid]
    public string $vatId = '';

    /**
     * This property contains the UUID of the entity
     * that value should be used.
     *
     * @Assert\NotBlank
     *
     * @Assert\Uuid
     */
    #[Assert\NotBlank]
    #[Assert\Uuid]
    public string $domain = '';

    /**
     * This property contains the emails to use for each EmailType.
     *
     * @var array<string, int>
     *
     * @Assert\NotBlank
     */
    #[Assert\NotBlank]
    public array $emails = [];
}
