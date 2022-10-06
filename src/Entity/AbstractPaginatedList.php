<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use JsonSerializable;

/**
 * @template D
 */
abstract class AbstractPaginatedList implements JsonSerializable
{
    /** @var array<string, mixed> */
    protected array $meta;

    /** @var array<string, mixed> */
    protected array $links;

    /** @var array<int, D> */
    protected array $data;

    /**
     * AbstractPaginatedList constructor.
     *
     * @param array<string, mixed> $meta
     * @param array<string, mixed> $links
     * @param array<int, D>        $data
     */
    public function __construct(array $meta, array $links, array $data)
    {
        $this->meta = $meta;
        $this->links = $links;
        $this->data = $data;
    }

    public function jsonSerialize()
    {
        return [
            'meta' => $this->getMeta(),
            'links' => $this->getLinks(),
            'data' => $this->getData(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @return array<string, mixed>
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @return array<int, mixed>
     */
    abstract public function getData(): array;
}
