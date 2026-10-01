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
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\LicenseTokenFactory;
use T3G\DatahubApiLibrary\Utility\JsonUtility;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class LicenseApi extends AbstractApi
{
    use HandlesUuids;

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

    /**
     * Issues a signed license token for the license. Issuing a token invalidates all tokens issued for the
     * license before.
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function createLicenseToken(string $licenseUuid): LicenseToken
    {
        $this->isValidUuidOrThrow($licenseUuid);

        return LicenseTokenFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/license/' . $licenseUuid . '/license-token'),
            )
        );
    }

    /**
     * Returns whether the license token is valid, i.e. signed by the Datahub, not expired and issued for a valid
     * license of a company that is not blocked from purchase. Requires the `license.validate` scope.
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function validateLicenseToken(string $token): bool
    {
        $response = $this->client->request(
            'POST',
            self::uri('/license/license-token/validate'),
            json_encode(['token' => $token], JSON_THROW_ON_ERROR)
        );

        return true === (JsonUtility::decode((string) $response->getBody())['valid'] ?? false);
    }
}
