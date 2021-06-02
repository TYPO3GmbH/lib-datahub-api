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
      "countryState": {
        "shortCode": "DE-NW",
        "label": "Nordrhein-Westfalen"
      },
      "companyName": "Aldi",
      "type": 16,
      "checksum": "30489455e915553ca09f9430fb95d6ab055c64326fd9ec17d7a4655f2a4d4fe5"
    }
');
