<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

/**
 * @template T
 */
abstract class AbstractList implements \JsonSerializable
{
    /** @var array<int, T> */
    protected array $data;

    /**
     * AbstractList constructor.
     *
     * @param array<int, mixed> $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function jsonSerialize(): array
    {
        return [
            'data' => $this->getData(),
        ];
    }

    /**
     * @return array<int, mixed>
     */
    abstract public function getData(): array;
}
