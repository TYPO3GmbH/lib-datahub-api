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
                '/user/addresses/' . $uuid,
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
                '/company/addresses/' . $uuid,
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
                '/users/' . rawurlencode(mb_strtolower($username)) . '/addresses',
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
                '/companies/' . $companyUuid . '/addresses',
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
                '/user/addresses/' . $uuid,
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
            '/user/addresses/' . $uuid,
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
                '/company/addresses/' . $uuid,
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
            '/company/addresses/' . $uuid,
        );
    }

    // Deprecated methods

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     * @deprecated since 24.04.2020, will be remove after 24.10.2020. Use getUserAddress or getCompanyAddress instead
     * @codeCoverageIgnore
     */
    public function getAddress(string $uuid): Address
    {
        trigger_error(__METHOD__ . ' has been marked as deprecated and will be removed after 24.10.2020. Use getUserAddress or getCompanyAddress instead', E_USER_DEPRECATED);
        return $this->getUserAddress($uuid);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     * @deprecated since 24.04.2020, will be remove after 24.10.2020. Use UpdateUserAddress or UpdateCompanyAddress instead
     * @codeCoverageIgnore
     */
    public function updateAddress(string $uuid, Address $address): Address
    {
        trigger_error(__METHOD__ . ' has been marked as deprecated and will be removed after 24.10.2020. Use UpdateUserAddress or UpdateCompanyAddress instead', E_USER_DEPRECATED);
        return $this->updateUserAddress($uuid, $address);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     * @deprecated since 24.04.2020, will be remove after 24.10.2020. Use deleteUserAddress or deleteCompanyAddress instead
     * @codeCoverageIgnore
     */
    public function deleteAddress(string $uuid): void
    {
        trigger_error(__METHOD__ . ' has been marked as deprecated and will be removed after 24.10.2020. Use deleteUserAddress or deleteCompanyAddress instead', E_USER_DEPRECATED);
        $this->deleteUserAddress($uuid);
    }
}
