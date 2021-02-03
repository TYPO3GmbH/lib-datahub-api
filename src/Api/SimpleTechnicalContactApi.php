<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\SimpleTechnicalContact;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\SimpleTechnicalContactFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class SimpleTechnicalContactApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function createSimpleTechnicalContactForInstance(string $uuid, SimpleTechnicalContact $simpleTechnicalContact): SimpleTechnicalContact
    {
        $this->isValidUuidOrThrow($uuid);

        return SimpleTechnicalContactFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/elts/instance/' . $uuid . '/simple-technical-contact'),
                json_encode($simpleTechnicalContact, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getSimpleTechnicalContact(string $uuid): SimpleTechnicalContact
    {
        $this->isValidUuidOrThrow($uuid);

        return SimpleTechnicalContactFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/elts/simple-technical-contact/' . $uuid)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function updateSimpleTechnicalContact(string $uuid, SimpleTechnicalContact $simpleTechnicalContact): SimpleTechnicalContact
    {
        $this->isValidUuidOrThrow($uuid);

        return SimpleTechnicalContactFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/elts/simple-technical-contact/' . $uuid),
                json_encode($simpleTechnicalContact, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deleteSimpleTechnicalContact(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/elts/simple-technical-contact/' . $uuid),
        );
    }
}
