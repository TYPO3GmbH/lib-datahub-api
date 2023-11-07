<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Assembler;

use T3G\DatahubApiLibrary\Dto\AbstractDto;

abstract class AbstractAssembler
{
    /**
     * @var class-string<AbstractDto>
     */
    protected string $dtoClassName;
    protected AbstractDto $dto;

    /**
     * @param array<string, mixed> $data
     */
    public function create(array $data): static
    {
        $instance = $this->createNewStub();
        $publicProperties = get_object_vars($instance);

        foreach ($data as $key => $value) {
            if (!property_exists($instance, $key)) {
                throw new \InvalidArgumentException(sprintf('Tried to set undefined property %s', $key));
            }

            if (array_key_exists($key, $publicProperties)) {
                $instance->{$key} = $value;
            } else {
                $setter = 'set' . ucwords(str_replace('_', '', $key));
                if (!is_callable([$instance, $setter])) {
                    throw new \InvalidArgumentException(sprintf('Cannot set property %s as it\'s not public and expected public setter %s() is not available', $key, $setter));
                }
                $instance->{$setter}($value);
            }
        }

        return $this;
    }

    public function getDto(): AbstractDto
    {
        return $this->dto;
    }

    protected function createNewStub(): AbstractDto
    {
        $this->dto = new $this->dtoClassName();

        return $this->dto;
    }
}
