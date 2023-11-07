<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Assembler\Admin;

use T3G\DatahubApiLibrary\Assembler\AbstractAssembler;
use T3G\DatahubApiLibrary\Dto\Admin\TransferEntityDto;

/**
 * @property TransferEntityDto $dto
 *
 * @method TransferEntityDto getDto()
 */
class TransferEntityAssembler extends AbstractAssembler
{
    protected string $dtoClassName = TransferEntityDto::class;

    public function setSourceOrganization(string $uuid): static
    {
        $this->dto->source = sprintf('organization:%s', $uuid);

        return $this;
    }

    public function setTargetOrganization(string $uuid): static
    {
        $this->dto->target = sprintf('organization:%s', $uuid);

        return $this;
    }
    public function setSourceUser(string $username): static
    {
        $this->dto->source = sprintf('user:%s', $username);

        return $this;
    }

    public function setTargetUser(string $username): static
    {
        $this->dto->target = sprintf('user:%s', $username);

        return $this;
    }
}
