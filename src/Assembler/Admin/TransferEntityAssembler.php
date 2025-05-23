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

    /**
     * @return $this
     */
    public function setSourceOrganization(string $uuid): self
    {
        $this->dto->source = sprintf('organization:%s', $uuid);

        return $this;
    }

    /**
     * @return $this
     */
    public function setTargetOrganization(string $uuid): self
    {
        $this->dto->target = sprintf('organization:%s', $uuid);

        return $this;
    }

    /**
     * @return $this
     */
    public function setSourceUser(string $username): self
    {
        $this->dto->source = sprintf('user:%s', $username);

        return $this;
    }

    /**
     * @return $this
     */
    public function setTargetUser(string $username): self
    {
        $this->dto->target = sprintf('user:%s', $username);

        return $this;
    }
}
