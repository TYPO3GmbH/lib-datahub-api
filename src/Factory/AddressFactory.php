<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\Address;

class AddressFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): Address
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    public static function fromArray(array $data): Address
    {
        return (new Address())
            ->setUuid($data['uuid'])
            ->setTitle($data['title'])
            ->setFirstName($data['firstName'])
            ->setLastName($data['lastName'])
            ->setAdditionalAddressLine1($data['additionalAddressLine1'])
            ->setAdditionalAddressLine2($data['additionalAddressLine2'])
            ->setCity($data['city'])
            ->setCountry($data['country']['iso'])
            ->setCountryIso3($data['country']['iso3'])
            ->setCountryLabel($data['country']['label'])
            ->setState($data['countryState']['shortCode'] ?? null)
            ->setStateLabel($data['countryState']['label'] ?? null)
            ->setStreet($data['street'])
            ->setZip($data['zip'])
            ->setType($data['type'])
            ->setCompanyName($data['companyName'] ?? null)
            ->setLatitude($data['latitude'] ?? 0.0)
            ->setLongitude($data['longitude'] ?? 0.0);
    }
}
