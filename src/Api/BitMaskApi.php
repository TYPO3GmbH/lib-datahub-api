<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;

class BitMaskApi extends AbstractApi
{
    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getAddressTypes(): array
    {
        $response = $this->client->request(
            'GET',
            '/bitmask/address/type',
        );

        return json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR)['data'];
    }
}
