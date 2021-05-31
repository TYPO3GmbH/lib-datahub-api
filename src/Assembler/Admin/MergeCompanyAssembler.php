<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Assembler\Admin;

use T3G\DatahubApiLibrary\Assembler\AbstractAssembler;
use T3G\DatahubApiLibrary\Dto\Admin\MergeCompanyDto;

/**
 * @property MergeCompanyDto $dto
 * @method MergeCompanyDto getDto()
 */
class MergeCompanyAssembler extends AbstractAssembler
{
    protected string $dtoClassName = MergeCompanyDto::class;
}
