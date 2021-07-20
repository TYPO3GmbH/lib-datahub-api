<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\Address;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\AddressFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class AddressApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getUserAddress(string $uuid): Address
    {
        $this->isValidUuidOrThrow($uuid);

        return AddressFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/user/addresses/' . $uuid),
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getCompanyAddress(string $uuid): Address
    {
        $this->isValidUuidOrThrow($uuid);

        return AddressFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/company/addresses/' . $uuid),
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function createAddressForUser(string $username, Address $address): Address
    {
        return AddressFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/users/' . rawurlencode(mb_strtolower($username)) . '/addresses'),
                json_encode($address, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function createAddressForCompany(string $companyUuid, Address $address): Address
    {
        $this->isValidUuidOrThrow($companyUuid);

        return AddressFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/companies/' . $companyUuid . '/addresses'),
                json_encode($address, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function updateUserAddress(string $uuid, Address $address): Address
    {
        $this->isValidUuidOrThrow($uuid);

        return AddressFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/user/addresses/' . $uuid),
                json_encode($address, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deleteUserAddress(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/user/addresses/' . $uuid),
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function updateCompanyAddress(string $uuid, Address $address): Address
    {
        $this->isValidUuidOrThrow($uuid);

        return AddressFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/company/addresses/' . $uuid),
                json_encode($address, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deleteCompanyAddress(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/company/addresses/' . $uuid),
        );
    }
}
