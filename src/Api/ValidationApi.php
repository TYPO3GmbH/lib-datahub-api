<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use T3G\DatahubApiLibrary\Dto\ValidateAddressDto;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;

class ValidationApi extends AbstractApi
{
    public function validateAddress(ValidateAddressDto $validateAddressDto): bool
    {
        try {
            $this->client->request(
                'POST',
                self::uri('/validation/address'),
                json_encode($validateAddressDto, JSON_THROW_ON_ERROR)
            );
        } catch (DatahubResponseException $e) {
            return false;
        }

        return true;
    }

    public function validateUsernameUniqueness(string $username): bool
    {
        try {
            $this->client->request(
                'GET',
                self::uri('/validation/username/' . mb_strtolower($username))
            );
        } catch (DatahubResponseException $e) {
            return false;
        }

        return true;
    }

    public function validateOrganizationDomainUniqueness(string $domain): bool
    {
        try {
            $this->client->request(
                'GET',
                self::uri('/validation/organization/domain/' . mb_strtolower($domain))
            );
        } catch (DatahubResponseException $e) {
            return false;
        }

        return true;
    }
}
