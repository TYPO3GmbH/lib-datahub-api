<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Assembler;

use T3G\DatahubApiLibrary\Dto\ValidateEltsCredentialsDto;

/**
 * @property ValidateEltsCredentialsDto $dto
 * @method ValidateEltsCredentialsDto getDto()
 */
class ValidateEltsCredentialsAssembler extends AbstractAssembler
{
    protected string $dtoClassName = ValidateEltsCredentialsDto::class;
}
