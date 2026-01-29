<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

return new Response(200, ['content-type' => 'application/json'], '
{
  "uuid": "00000000-0000-0000-0000-000000000000",
  "companyType": "AGENCY",
  "title": "Test Company",
  "slug": "test-company",
  "email": "oelie@boelie.com",
  "vatId": "DE 123 456 789",
  "membership": {
    "uuid": "22222222-2222-2222-2222-222222222222",
    "subscriptionIdentifier": "sub_CCCCCCCCC",
    "subscriptionType": "membership",
    "subscriptionSubType": "GOLD",
    "subscriptionStatus": "active",
    "payload": {
      "items": [
        {"foo": "bar"}
      ]
    },
    "validUntil": "2020-10-03T10:00:00+00:00",
    "nextCancellationPossibleAt": "2021-10-03T10:00:00+00:00"
  },
  "domain": "typo3.com",
  "foundingPartner": true,
  "psl": true,
  "offeredServices": [
      "DESIGN",
      "DEVELOPMENT"
  ],
  "addresses": [
    {
      "uuid": "00000000-0000-0000-0000-000000000000",
      "title": "Home",
      "firstName": "Max",
      "lastName": "Mustermann",
      "additionalAddressLine1": "Musterabteilung",
      "additionalAddressLine2": "Sondermuster",
      "street": "Musterstraße 123",
      "zip": "12345",
      "city": "Musterdorf",
      "country": {
        "iso": "DE",
        "iso3": "DEU",
        "label": "Germany"
      },
      "countryState": null,
      "companyName": null,
      "type": 16,
      "checksum": "30489455e915553ca09f9430fb95d6ab055c64326fd9ec17d7a4655f2a4d4fe5"
    },
    {
      "uuid": "00000000-0000-0000-0000-000000000000",
      "title": "Home",
      "firstName": "Max",
      "lastName": "Mustermann",
      "additionalAddressLine1": "Musterabteilung",
      "additionalAddressLine2": "Sondermuster",
      "street": "Musterstraße 123",
      "zip": "12345",
      "city": "Musterdorf",
      "country": {
        "iso": "DE",
        "iso3": "DEU",
        "label": "Germany"
      },
      "countryState": null,
      "companyName": null,
      "type": 16,
      "checksum": "30489455e915553ca09f9430fb95d6ab055c64326fd9ec17d7a4655f2a4d4fe5"
    }
  ],
  "employees": [
    {
      "user": {
        "username": "neoblack",
        "firstName": "Oelie",
        "lastName": "Boelie",
        "gravatarString": "da262bfed6eb8967574348ebca9fd51c",
        "status": {
          "membership": "COMMUNITY"
        }
      },
      "uuid": "aaa-bbb",
      "role": "OWNER",
      "joinedAt": "2021-02-26T00:00:00+00:00",
      "leftAt": null
    },
    {
      "user": {
        "username": "Oelie Boelie",
        "firstName": "Oelie",
        "lastName": "Boelie",
        "gravatarString": "da262bfed6eb8967574348ebca9fd51c",
        "status": {
          "membership": "COMMUNITY"
        }
      },
      "uuid": "aaa-bbb2",
      "role": "MANAGER",
      "joinedAt": "2021-02-26T00:00:00+00:00",
      "leftAt": null
    },
    {
      "user": {
        "username": "neoblack2",
        "firstName": "Oelie",
        "lastName": "Boelie",
        "gravatarString": "da262bfed6eb8967574348ebca9fd51c",
        "status": {
          "membership": "COMMUNITY"
        }
      },
      "uuid": "aaa-bbb3",
      "role": "EMPLOYEE",
      "joinedAt": "2021-02-26T00:00:00+00:00",
      "leftAt": null
    },
    {
      "user": {
        "username": "neoblack3",
        "firstName": "Oelie",
        "lastName": "Boelie",
        "gravatarString": "da262bfed6eb8967574348ebca9fd51c",
        "status": {
          "membership": "COMMUNITY"
        }
      },
      "uuid": "aaa-bbb4",
      "role": "EMPLOYEE",
      "joinedAt": "2021-02-26T00:00:00+00:00",
      "leftAt": null
    }
  ],
  "examAccesses": [
    {
      "uuid": "22222222-2222-2222-2222-222222222222",
      "voucher": "22222222-2222-2222-2222-222222222222",
      "certificationType": "TCCD",
      "certificationVersion": "10.4",
      "status": "READY"
    },
    {
      "uuid": "33333333-3333-3333-3333-333333333333",
      "voucher": "33333333-3333-3333-3333-333333333333",
      "certificationType": "TCCC",
      "certificationVersion": "9.5",
      "status": "READY"
    }
  ],
  "status": {
    "isFoundingPartner": true,
    "membership": "GOLD",
    "partnerTypes": []
  }
}
');
