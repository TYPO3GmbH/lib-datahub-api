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
 *
 * @implements \ArrayAccess<int, mixed>
 * @implements \IteratorAggregate<int, mixed>
 */
abstract class AbstractList implements \JsonSerializable, \Countable, \ArrayAccess, \IteratorAggregate
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

    public function count(): int
    {
        return count($this->getData());
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->getData());
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->getData()[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->getData()[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->getData()[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->getData()[$offset]);
    }

    /**
     * @return array<int, mixed>
     */
    abstract public function getData(): array;
}
