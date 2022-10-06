<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Utility\JsonUtility;

class BitMaskApi extends AbstractApi
{
    /**
     * @return array<int, string>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getAddressTypes(): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/bitmask/address/type'),
        );

        return JsonUtility::decode((string) $response->getBody())['data'] ?? [];
    }
}
