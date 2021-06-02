<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\MailAddressFilter;

/**
 * @method static array{entities: array<string, mixed>} responseToArray(ResponseInterface $response)
 * @extends AbstractFactory<MailAddressFilter[]>
 */
class MailAddressFilterListFactory extends AbstractFactory
{
    /**
     * @param array{entities: array<string, mixed>} $list
     * @return MailAddressFilter[]
     */
    public static function fromArray(array $list): array
    {
        return array_map(static function (array $data): MailAddressFilter {
            return MailAddressFilterFactory::fromArray($data);
        }, $list['entities']);
    }
}
