<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Demand\OfferSearchDemand;
use T3G\DatahubApiLibrary\Dto\CreateOfferDto;
use T3G\DatahubApiLibrary\Entity\Offer;
use T3G\DatahubApiLibrary\Entity\OfferList;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\OfferFactory;
use T3G\DatahubApiLibrary\Factory\OfferListFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class OfferApi extends AbstractApi
{
    use HandlesUuids;

    public function createOfferForUser(string $username, CreateOfferDto $dto): Offer
    {
        return OfferFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/users/' . mb_strtolower($username) . '/offer'),
                json_encode($dto, JSON_THROW_ON_ERROR)
            )
        );
    }

    public function createOfferForCompany(string $uuid, CreateOfferDto $dto): Offer
    {
        $this->isValidUuidOrThrow($uuid);

        return OfferFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/companies/' . $uuid . '/offer'),
                json_encode($dto, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @param string $username
     *
     * @return Offer[]
     */
    public function getOffersForUser(string $username): array
    {
        return OfferListFactory::fromResponseDataCollection(
            $this->client->request(
                'GET',
                self::uri('/users/' . mb_strtolower($username) . '/offers')
            )
        )->getData();
    }

    /**
     * @param string $uuid
     *
     * @return Offer[]
     */
    public function getOffersForCompany(string $uuid): array
    {
        $this->isValidUuidOrThrow($uuid);

        return OfferListFactory::fromResponseDataCollection(
            $this->client->request(
                'GET',
                self::uri('/companies/' . $uuid . '/offers')
            )
        )->getData();
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     */
    public function searchOffers(OfferSearchDemand $offerSearchDemand): OfferList
    {
        return OfferListFactory::fromResponseDataCollection(
            $this->client->request(
                'POST',
                self::uri('/offer/search'),
                json_encode($offerSearchDemand, JSON_FORCE_OBJECT | JSON_THROW_ON_ERROR)
            )
        );
    }

    public function getOffer(string $uuid): Offer
    {
        $this->isValidUuidOrThrow($uuid);

        return OfferFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/offer/' . $uuid)
            )
        );
    }
}
