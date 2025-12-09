<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Assembler;

use T3G\DatahubApiLibrary\Dto\SwitchMembershipDto;

/**
 * @property SwitchMembershipDto $dto
 *
 * @method SwitchMembershipDto getDto()
 */
class SwitchMembershipAssembler extends AbstractAssembler
{
    protected string $dtoClassName = SwitchMembershipDto::class;
}
