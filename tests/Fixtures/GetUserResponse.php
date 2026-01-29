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
  "username": "oelie-boelie",
  "firstName": "Oelie",
  "lastName": "Boelie",
  "email": "oelie.boelie@typo3.org",
  "phone": "+4912356789",
  "discordId": "492824791867326464",
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
      "title": "Company",
      "firstName": "Max",
      "lastName": "Mustermann",
      "additionalAddressLine1": "Musterabteilung",
      "additionalAddressLine2": "Sondermuster",
      "street": "Emanuel-Leutze-Str. 11",
      "zip": "40457",
      "city": "Düsseldorf",
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
  "links": [
    {
      "uuid": "00000000-0000-0000-0000-000000000000",
      "value": "naegler.hamburg",
      "type": "website",
      "highlight": true,
      "url": "https:\/\/naegler.hamburg"
    },
    {
      "uuid": "00000000-0000-0000-0000-000000000000",
      "value": "typo3.com",
      "type": "website",
      "highlight": false,
      "url": "https:\/\/typo3.com"
    }
  ],
  "certifications": [
    {
      "uuid": "00000000-0000-0000-0000-000000000000",
      "type": "TCCI",
      "version": "10.4",
      "auditType": "PRESENCE",
      "status": "PASSED",
      "examLocation": "Aldi",
      "examDate": "2020-02-26T00:00:00+00:00",
      "ndaSigned": true,
      "rulesAccepted": true,
      "proctoringLink": null,
      "examUrl": "https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000"
    }
  ],
  "emailAddresses": [
    {
      "uuid": "311b4cf9-761f-4fb3-b1e4-6b23e4a91c0b",
      "email": "oelie.boelie@typo3.org",
      "type": 273,
      "optIn": "2020-12-16T10:13:26+00:00"
    }
  ],
  "membership": {
    "uuid": "00000000-0000-0000-0000-000000000000",
    "subscriptionIdentifier": "sub_AAAAAAAAA",
    "subscriptionType": "membership",
    "subscriptionSubType": "COMMUNITY",
    "subscriptionStatus": "active",
    "payload": {
      "items": [
        {"foo": "bar"}
      ]
    },
    "validUntil": "2021-09-03T10:00:00+00:00",
    "nextCancellationPossibleAt": "2022-09-03T10:00:00+00:00"
  },
  "status": {
    "membership": "COMMUNITY"
  }
}
');
