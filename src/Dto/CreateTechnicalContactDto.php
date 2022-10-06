<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Dto;

class CreateTechnicalContactDto extends AbstractDto
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $username;
    public string $plan;
    public string $instance;
}
