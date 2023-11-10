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
  "phone": null,
  "email": "oelie@boelie.nl",
  "emailAddresses": [
    {
      "uuid": "311b4cf9-761f-4fb3-b1e4-6b23e4a91c0b",
      "email": "oelie@boelie.nl",
      "type": 273,
      "optIn": "2020-12-16T10:13:26+00:00"
    }
  ],
  "status": {
    "membership": "COMMUNITY"
  }
}
');
