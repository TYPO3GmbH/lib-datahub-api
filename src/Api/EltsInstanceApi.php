<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\EltsInstance;
use T3G\DatahubApiLibrary\Entity\EltsInstanceList;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\EltsInstanceFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class EltsInstanceApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function createInstanceForPlan(string $uuid, EltsInstance $eltsInstance): EltsInstance
    {
        $this->isValidUuidOrThrow($uuid);

        return EltsInstanceFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/elts/plan/' . $uuid . '/instance'),
                json_encode($eltsInstance, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function canCreateInstanceForPlan(string $uuid): bool
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'GET',
            self::uri('/elts/plan/' . $uuid . '/instance/can-create')
        );

        return true;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getInstance(string $uuid): EltsInstance
    {
        $this->isValidUuidOrThrow($uuid);

        return EltsInstanceFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/elts/instance/' . $uuid)
            )
        );
    }

    /**
     * @param string|null $companyUuid
     *
     * @return EltsInstanceList
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getInstances(?string $companyUuid = null): EltsInstanceList
    {
        $uri = '/elts/instances';
        if (null !== $companyUuid) {
            $this->isValidUuidOrThrow($companyUuid);
            $uri .= '/' . $companyUuid;
        }

        return EltsInstanceFactory::fromResponseDataCollection(
            $this->client->request(
                'GET',
                self::uri($uri)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function updateInstance(string $uuid, EltsInstance $eltsInstance): EltsInstance
    {
        $this->isValidUuidOrThrow($uuid);

        return EltsInstanceFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/elts/instance/' . $uuid),
                json_encode($eltsInstance, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deleteInstance(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/elts/instance/' . $uuid),
        );
    }
}
