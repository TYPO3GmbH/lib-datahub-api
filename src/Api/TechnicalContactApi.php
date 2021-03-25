<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Dto\CreateTechnicalContactDto;
use T3G\DatahubApiLibrary\Entity\TechnicalContact;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\TechnicalContactFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class TechnicalContactApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @param CreateTechnicalContactDto $createTechnicalContactDto
     * @return TechnicalContact
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     */
    public function createTechnicalContact(CreateTechnicalContactDto $createTechnicalContactDto): TechnicalContact
    {
        return TechnicalContactFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/elts/technical-contact'),
                json_encode($createTechnicalContactDto, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getTechnicalContact(string $uuid): TechnicalContact
    {
        $this->isValidUuidOrThrow($uuid);

        return TechnicalContactFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/elts/technical-contact/' . $uuid)
            )
        );
    }

    /**
     * @param string $uuid
     * @return TechnicalContact
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function confirmTechnicalContact(string $uuid): TechnicalContact
    {
        $this->isValidUuidOrThrow($uuid);

        return TechnicalContactFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri(sprintf('/elts/technical-contact/%s/confirm', $uuid))
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deleteTechnicalContact(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/elts/technical-contact/' . $uuid),
        );
    }
}
