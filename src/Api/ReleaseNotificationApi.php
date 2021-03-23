<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Dto\CreateReleaseNotificationDto;
use T3G\DatahubApiLibrary\Entity\ReleaseNotification;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\ReleaseNotificationFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class ReleaseNotificationApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @param CreateReleaseNotificationDto $createReleaseNotificationDto
     * @return ReleaseNotification
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     */
    public function createReleaseNotification(CreateReleaseNotificationDto $createReleaseNotificationDto): ReleaseNotification
    {
        return ReleaseNotificationFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/elts/release-notification'),
                json_encode($createReleaseNotificationDto, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @param string $uuid
     * @return ReleaseNotification
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getReleaseNotification(string $uuid): ReleaseNotification
    {
        $this->isValidUuidOrThrow($uuid);

        return ReleaseNotificationFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/elts/release-notification/' . $uuid)
            )
        );
    }

    /**
     * @param string $uuid
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deleteReleaseNotification(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/elts/release-notification/' . $uuid),
        );
    }
}
