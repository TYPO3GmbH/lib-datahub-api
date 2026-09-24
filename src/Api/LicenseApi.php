<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\LicenseToken;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\LicenseTokenFactory;

class LicenseApi extends AbstractApi
{
    /**
     * Issues a short-lived, signed license token for the current user, to be used for downloads.
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function createDownloadToken(): LicenseToken
    {
        return LicenseTokenFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/license/download-token'),
            )
        );
    }
}
