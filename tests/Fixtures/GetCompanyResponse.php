<?php declare(strict_types=1);

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
  "hubspotId": 4711,
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
    "validUntil": "2020-10-03T10:00:00+00:00"
  },
  "domain": "typo3.com",
  "foundingPartner": true,
  "psl": true,
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
      "type": 16
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
      "type": 16
    }
  ],
  "employees": [
    {
      "user": {
        "username": "neoblack",
        "firstName": "Oelie",
        "lastName": "Boelie",
        "gravatarString": "da262bfed6eb8967574348ebca9fd51c"
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
        "gravatarString": "da262bfed6eb8967574348ebca9fd51c"
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
        "gravatarString": "da262bfed6eb8967574348ebca9fd51c"
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
        "gravatarString": "da262bfed6eb8967574348ebca9fd51c"
      },
      "uuid": "aaa-bbb4",
      "role": "EMPLOYEE",
      "joinedAt": "2021-02-26T00:00:00+00:00",
      "leftAt": null
    }
  ]
}
');
