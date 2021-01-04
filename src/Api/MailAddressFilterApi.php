<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use T3G\DatahubApiLibrary\Entity\MailAddressFilter;
use T3G\DatahubApiLibrary\Factory\MailAddressFilterFactory;
use T3G\DatahubApiLibrary\Factory\MailAddressFilterListFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class MailAddressFilterApi extends AbstractApi
{
    use HandlesUuids;

    public function getMailAddressFilter(string $uuid): MailAddressFilter
    {
        $this->isValidUuidOrThrow($uuid);

        return MailAddressFilterFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/mail-address-filter/' . $uuid)
            )
        );
    }

    /**
     * @return MailAddressFilter[]
     */
    public function getAllMailAddressFilters(): array
    {
        return MailAddressFilterListFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/mail-address-filter/list')
            )
        );
    }

    public function createMailAddressFilter(MailAddressFilter $filter): MailAddressFilter
    {
        return MailAddressFilterFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/mail-address-filter'),
                json_encode($filter, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    public function updateMailAddressFilter(string $uuid, MailAddressFilter $filter): MailAddressFilter
    {
        $this->isValidUuidOrThrow($uuid);

        return MailAddressFilterFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/mail-address-filter/' . $uuid),
                json_encode($filter, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    public function deleteMailAddressFilter(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/mail-address-filter/' . $uuid)
        );
    }
}
